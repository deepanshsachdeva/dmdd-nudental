<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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

    public function view($id){

        $appointments=DB::select("
            select
                appointment.appointment_id,
                appointment.start_date,
                appointment.end_date,
                appointment.status,
                appointment.next_appointment_id, 
                appointment.created_at
            from appointment 
            where appointment.appointment_id= $id");

            
        throw_if(sizeof($appointments) == 0, ModelNotFoundException::class);

        $appointment = head($appointments);

        $location=head(DB::select("
        select 
        o.name as location_name,
        o.address1,
        o.city,
        o.state,
        o.zip_code
        from office o JOIN room r on r.office_id = o.office_id 
        JOIN appointment a on a.room_id =r.room_id 
        where appointment_id = $id"));
    
        
        $patient=head(DB::select("
        select 
        p.fname,
        p.lname,
        p.phone,
        p.email,
        case 
        when gender = 'M' then 'Male' 
        when gender = 'F' then 'Female'
        else 'Other' end as gender ,
        LEFT((string_agg(concat(i.name, ','), ' ')), LEN((string_agg(concat(i.name, ','), ' '))) - 1) as insurances     
        from appointment a 
        JOIN patient p on a.patient_id = p.patient_id 
        JOIN patient_insurance pi on pi.patient_id = p.patient_id 
        JOIN insurance i on i.insurance_id = pi.insurance_id
        where appointment_id = $id
        group by
        p.fname,
        p.lname,
        p.phone,
        p.email,
        gender
    "));

        // dd($patient);

        // $providers=DB::select("
        // Select 
        // p.fname,
        // p.lname,
        // p.phone,
        // p.email,
        // case 
        // when gender = 'M' then 'Male' 
        // when gender = 'F' then 'Female'
        // else 'Other' end as gender,
        // LEFT((string_agg(concat(l.name, ','), ' ')), LEN((string_agg(concat(l.name, ','), ' '))) - 1) as licenses,
        // LEFT((string_agg(concat(s.name, ','), ' ')), LEN((string_agg(concat(s.name, ','), ' '))) - 1) as specialties
        // from specialty s 
        // JOIN provider_specialty ps on ps.specialty_id = s.specialty_id 
        // JOIN provider p on ps.provider_id = p.provider_id
        // JOIN appointment_provider ap on ap.provider_id = p.provider_id 
        // JOIN provider_license pl on p.provider_id = pl.provider_id
        // JOIN license l on pl.license_id = l.license_id 
        // where appointment_id = $id group by   
        // p.fname,
        // p.lname,
        // p.phone,
        // p.email, 
        // gender
        
        // "    
        // );

$providers=DB::select("
        Select 
        p.fname,
        p.lname,
        p.phone,
        p.email,
        case 
        when gender = 'M' then 'Male' 
        when gender = 'F' then 'Female'
        else 'Other' end as gender
        from provider p 
        JOIN appointment_provider ap on ap.provider_id = p.provider_id 
        where appointment_id = $id  
         
        "    
    );

    //dd($providers);

    $provider_data = [];

    foreach($providers as $provider) {
        $data = [];

        $data['provider'] = $provider;

        //query speciali

        $licenses=(DB::select("
    select 
    l.name
    from license l 
    JOIN provider_license pl on pl.license_id=l.license_id 
    JOIN provider p on p.provider_id = pl.provider_id
    JOIN appointment_provider ap on ap.provider_id=p.provider_id 
    where appointment_id = $id 
    
    "));

     
    $specialties = (DB::select("
    select
    s.name 
    from specialty s
    JOIN provider_specialty ps on ps.specialty_id=s.specialty_id 
    JOIN provider p on p.provider_id = ps.provider_id
    JOIN appointment_provider ap on ap.provider_id=p.provider_id 
    where appointment_id = $id 
    "));


    $data['licenses'] = $licenses;
    $data['specialties'] = $specialties;
    $provider_data[] = $data;

        // $spec = [1,2,3];

        // $lic = [4,5];

        // $data['spec'] = $spec;
        // $data['lic'] = $lic;

        // $provider_data[] = $data;
    }

   //dd($provider_data);


    
    // $licenses=(DB::select("
    // select 
    // l.name as license
    // from license l 
    // JOIN provider_license pl on pl.license_id=l.license_id 
    // JOIN provider p on p.provider_id = pl.provider_id
    // JOIN appointment_provider ap on ap.provider_id=p.provider_id 
    // where appointment_id = $id 
    
    // "));


    // $specialties = (DB::select("
    // select
    // s.name as specialty 
    // from specialty s
    // JOIN provider_specialty ps on ps.specialty_id=s.specialty_id 
    // JOIN provider p on p.provider_id = ps.provider_id
    // JOIN appointment_provider ap on ap.provider_id=p.provider_id 
    // where appointment_id = $id 
    // "));

       
       


        return response()->view("appointments.view", compact('appointment','location','patient','provider_data'));

    }

}


