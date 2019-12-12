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
                treatment.created_at
            from treatment
            left join tooth on tooth.tooth_id = treatment.tooth_id
            left join surface on surface.surface_id = treatment.surface_id
            inner join treatment_catalogue on treatment.treatment_catalogue_id = treatment_catalogue.treatment_catalogue_id
            where appointment_id = {$appointment->appointment_id}
        ");

        return response()->view('treatments.index', compact('appointment', 'treatments'));
    }

    public function createForm(Appointment $appointment) {
        $treatment_catalogue = DB::select("
            select
                treatment_catalogue_id,
                name
            from treatment_catalogue
        ");

        $teeth = DB::select("
            select
                tooth_id,
                tooth_type,
                tooth_code
            from tooth
        ");

        $surfaces = DB::select("
            select
                surface_id,
                surface_code
            from surface
        ");

        return response()->view('treatments.new', compact('appointment', 'treatment_catalogue', 'teeth', 'surfaces'));
    }

    public function create(Appointment $appointment) {
        //
    }
}
