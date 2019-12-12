<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index(Appointment $appointment) {
        
        $treatments = DB::select("
            select 
                treatment.treatment_id as treatment_id,
                treatment_catalogue.name as treatment_name,
                tooth.tooth_code as tooth_code,
                surface.surface_code as surface_code,
                treatment.comment,
                treatment.created_at
            from treatment
            left join tooth on tooth.tooth_id = treatment.tooth_id
            left join surface on surface.surface_id = treatment.surface_id
            inner join treatment_catalogue on treatment.treatment_catalogue_id = treatment_catalogue.treatment_catalogue_id
            where appointment_id = ?
        ", [$appointment->appointment_id]);

        return response()->view('treatments.index', compact('appointment', 'treatments'));
    }

    public function createForm(Appointment $appointment) {
        $treatment_catalogue = DB::select("
            select
                treatment_catalogue_id,
                name
            from treatment_catalogue
        ");

        $patient_info = head(DB::select("
            select
                case
                    when datediff(year, patient_secure.dob, getdate()) > 18 then 'S'
                    else 'P'
                end as stage
            from patient
            inner join patient_secure on patient.patient_id = patient_secure.patient_id
            where patient.patient_id = ?
        ", [$appointment->patient_id]));

        $teeth = DB::select("
            select
                tooth_id,
                tooth_type,
                tooth_code
            from tooth
            where stage = ?
        ", [$patient_info->stage]);

        $surfaces = DB::select("
            select
                surface_id,
                surface_code
            from surface
        ");

        return response()->view('treatments.new', compact('appointment', 'treatment_catalogue', 'teeth', 'surfaces'));
    }

    public function create(Appointment $appointment) {
        $treatment_catalogue = request()->input('treatment_catalogue');
        $tooth = request()->input('tooth');
        $surface = request()->input('surface');
        $blob_path = request()->input('path');
        $comment = request()->input('comment');
        $user_id = auth()->user()->user_id;

        $result = DB::select("EXEC dbo.proc_create_treatment ?,?,?,?,?,?,?", 
            [$appointment->appointment_id, $treatment_catalogue, $tooth, $surface, $blob_path, $comment, $user_id]);

        if(isset($result[0]->Error)) {
            return redirect()->back()->withErrors($result[0]->Error)->withInput();
        }
        else{
            return redirect()->route('treatments.index', $appointment);
        }
    }
}
