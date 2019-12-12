@extends('layouts.app')
@section ('title' , 'Treatments')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Treatments for appointment #NU{{ $appointment->ppointment_id }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('treatments.new', $appointment) }}" class="btn btn-primary" role="button">+ New</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Treatment ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Tooth</th>
                        <th scope="col">Surface</th>
                        <th scope="col">Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($treatments as $treatment)
                    <tr>
                        <td scope="row">#T{{ $treatment->treatment_id }}</td>
                        <td>{{ $treatment->treatment_name }}</td>
                        <td>{{ ($treatment->tooth_code) ?: 'NA' }}</td>
                        <td>{{ ($treatment->surface_code) ?: 'NA' }}</td>
                        <td>{{ $treatment->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
