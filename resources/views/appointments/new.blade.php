@extends('layouts.app')
@section ('title' , 'Create appointment')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Create Appointment</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary" role="button">&larr; Back</a>
        </div>
    </div>
    
    <div class="row">

        <div class="col-6">

         <form action="" method="post">
                <div class="form-group col">
                <label>Provider</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>

                 <div class="form-group col">
                <label>Patient</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                 </div>

                 <div class="form-group col">
                <label>Location</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>

                <div class="form-group col">
                <label>room</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>


                <div class="form-group col">
                <label>Follow Up Appointment</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
                </div>
                
                 
                <!-- <input type="date" id="start" name="trip-start"
                value="2018-07-22"
                min="2018-01-01" max="2018-12-31">
                    <input type="time" id="appt" name="appt"
                min="09:00" max="18:00" required> -->
                <div class="form-group col">
                <label for="appt">Choose a time to start appointment:</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group col">
                <label for="appt">Choose a time end appointment</label>
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col">
                <button type="submit" class="btn btn-primary">Create</button>
                </div>

                

                

         </form>

        </div>

    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/datetimepicker.css') }}" />
@endpush

@push('scripts')
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $(function () {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker();
    });
</script>
@endpush
