@extends('layouts.app')
@section ('title' , 'appointments')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Appointments</h1>
        </div>
        <div class="col text-right">
            <a href="#" class="btn btn-primary" role="button">+ New</a>
        </div>
    </div>
    <form action="">
        <div class="form-row">
            <div class="form-group col">
                <label>Location</label>
                <select class="form-control">
                
                    <option>Default select </option>
                </select>
            </div>

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
                <label>status</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
            </div>

            <div class="form-group col">
                <label>Date</label>
                <select class="form-control">
                    <option>Default select </option>
                </select>
            </div>


        </div>
        <div class="form-group text-right ">
            <a href="#" class="btn btn-primary" role="button">Filter</a>
            <a href="#" class="btn btn-secondary" role="button">Reset</a>
        </div>
    </form>


    <div class="row">

        <div class="col">

            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Appointment Id</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Provider</th>
                        <th scope="col">Location</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created On</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td scope="row"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</div>

@endsection
