<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    public function index() {
        $locations = DB::select("select office_id, name from office");
        $providers = DB::select("select provider_id, fname, lname from provider");
        $patients = DB::select("select patient_id, fname, lname from patient");

        $q_location = request()->input('location');
        $q_provider = request()->input('provider');
        $q_patient = request()->input('patient');
        $q_status = request()->input('status');
        $q_date = request()->input('date');

        $query = "
            select
                appointment.appointment_id,
                LEFT((string_agg(concat(provider.fname, ','), ' ')), LEN((string_agg(concat(provider.fname, ','), ' '))) - 1) as providers,
                concat(patient.fname, ' ', patient.lname) as patient,
                concat(office.name, ' - ', room.room_code) as location,
                appointment.start_date,
                appointment.end_date,
                appointment.status,
                appointment.next_appointment_id, 
                appointment.created_at
            from appointment 
            inner join appointment_provider on appointment_provider.appointment_id = appointment.appointment_id
            inner join provider on provider.provider_id = appointment_provider.provider_id
            inner join patient on appointment.patient_id = patient.patient_id
            inner join room on room.room_id = appointment.room_id
            inner join office on office.office_id = room.office_id";

        if ($q_location || $q_provider || $q_patient || $q_status || $q_status || $q_date) {
            $query .= " where ";

            $filters = [];
             
            if ($q_location) {
                $filters['office.office_id'] = $q_location;
                // $query .= (" office.office_id = ".$q_location);
            }

            if ($q_provider) {
                $filters['provider.provider_id'] = $q_provider;
                // $query .= (" provider.provider_id = ".$q_provider);
            }
            
            if ($q_patient) {
                $filters['patient.patient_id'] = $q_patient;
                // $query .= (" patient.patient_id = ".$q_patient);
            }

            if ($q_status) {
                $filters['appointment.status'] = $q_status;
                // $query .= (" appointment.status = ".$q_status);
            }

            if ($q_date) {
                $filters['cast(appointment.start_date as date)'] = "'".$q_date."'";
                // $query .= (" cast(appointment.start_date as date) = '".$q_date."'");
            }
            
            $i = 1;
            foreach($filters as $filter => $value){
                if ($i++ > 1) {
                    $query .= " and ";
                }

                $query .= " $filter = $value ";
            }
        }
        
        $group = " group by 
            appointment.appointment_id, 
            appointment.start_date, 
            appointment.end_date, 
            appointment.status, 
            appointment.next_appointment_id, 
            appointment.created_at, 
            patient.lname, 
            patient.fname, 
            office.name, 
            room.room_code
        ";

        $query = $query.$group;

        $appointments = DB::select($query);

        return response()->view('appointments.index', compact('appointments', 'locations', 'providers', 'patients'));
    }

    public function createForm() {
        return response()->view('appointments.new');
    }

}


