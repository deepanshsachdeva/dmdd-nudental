@extends('layouts.app')
@section ('title' , 'View appointment')
@section ('content')


<div class="container">

    <h1>Appointment NU{{$appointment->appointment_id}}</h1>
    <h2>Timings</h2>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                <td scope="row">{{ $appointment->start_date}}</td>
                <td>{{ $appointment->end_date}}</td>

            </tr>

        </tbody>
    </table>


    <h2>Location</h2>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Street</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">zip code</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td scope="row">{{ $location->location_name}}</td>
                <td>{{ $location->address1}}</td>
                <td>{{ $location->city}}</td>
                <td>{{ $location->state}}</td>
                <td>{{ $location->zip_code}}</td>
            </tr>

        </tbody>
    </table>


    <h2>Patient</h2>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Insurance</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row">{{ $patient->fname}}</td>
                <td>{{ $patient->lname}}</td>
                <td>{{ $patient->phone}}</td>
                <td>{{ $patient->email}}</td>
                <td>{{ $patient->gender}}</td>
                <td>{{ $patient->insurances}}</td>
            </tr>
        </tbody>
    </table>

    <h2>Provider</h2>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Speciality</th>
                <th scope="col">License</th>
            </tr>
        </thead>
        <tbody>

            @foreach($provider_data as $provider)
            <tr>
                <td scope="row">{{ $provider['provider']->fname}}</td>
                <td>{{ $provider['provider']->lname}}</td>
                <td>{{ $provider['provider']->phone}}</td>
                <td>{{ $provider['provider']->email}}</td>
                <td>{{ $provider['provider']->gender}}</td>
                <td>
                    <ul class="p-0">
                        @foreach($provider['specialties'] as $specialty)
                        <li>
                            {{$specialty->name}}

                        </li>
                        @endforeach
                    </ul>

                </td>
                <td>
                <ul class="p-0">
                    @foreach($provider['licenses'] as $license)
                    <li>
                        {{$license->name}}

                    </li>
                    @endforeach
                    </ul>
                <td>
            </tr>

            @endforeach
        </tbody>
    </table>

</div>
@endsection
