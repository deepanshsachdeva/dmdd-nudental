@extends('layouts.app')
@section ('title' , 'appointments')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Appointments</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('appointments.new') }}" class="btn btn-primary" role="button">+ New</a>
        </div>
    </div>
    <form action="{{ route('appointments.index') }}" method="GET">
        <div class="form-row">
            <div class="form-group col">
                <label>Location</label>
                <select class="form-control" name="location">
                    <option value="">--- Select Location ---</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->office_id }}" @if(request()->input('location') == $location->office_id)) selected @endif>{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <label>Provider</label>
                <select class="form-control" name="provider">
                    <option value="" selected>--- Select Provider ---</option>
                    @foreach($providers as $provider)
                    <option value="{{ $provider->provider_id }}" @if(request()->input('provider') == $provider->provider_id)) selected @endif>{{ $provider->fname }} {{ $provider->lname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <label>Patient</label>
                <select class="form-control" name="patient">
                    <option value="">--- Select Patient ---</option>
                    @foreach($patients as $patient)
                    <option value="{{ $patient->patient_id }}" @if(request()->input('patient') == $patient->patient_id)) selected @endif>{{ $patient->fname }} {{ $patient->lname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="">--- Select Status ---</option>
                    <option value="B" @if(request()->input('status') == "B")) selected @endif>Booked</option>
                    <option value="O" @if(request()->input('status') == "O")) selected @endif>Open</option>
                    <option value="C" @if(request()->input('status') == "C")) selected @endif>Cancelled</option>  
                </select>
            </div>
            <div class="form-group col">
                <label>Date</label>
                <input class="form-control" type="text" name="date" value="{{ request()->input('date') }}">
            </div>
        </div>
        <div class="form-group text-right ">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary" role="button">Reset</a>
        </div>
    </form>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Providers</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Location</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Status</th>
                        <th scope="col">Next Appointment</th>
                        <th scope="col">Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                        <td scope="row"><a href="{{route('appointments.view', $appointment->appointment_id )}}">NU{{ $appointment->appointment_id }}</a></td>
                        <td>{{ $appointment->providers}}</td>
                        <td>{{ $appointment->patient}}</td>
                        <td>{{ $appointment->location }}</td>
                        <td>{{ $appointment->start_date }}</td>
                        <td>{{ $appointment->end_date }}</td>
                        <td>{{ $appointment->status }}</td>
                        <td>{{ ($appointment->next_appointment_id) ? 'Yes' : 'No' }}</td>
                        <td>{{ $appointment->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
