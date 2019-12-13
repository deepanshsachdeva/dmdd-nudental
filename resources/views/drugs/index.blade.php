@extends('layouts.app')
@section('title', 'Drugs')
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1>Drugs</h1>
        </div>
        <div class="col text-right">
            <a href="{{route('drugs.new')}}" class="btn btn-primary" role="button">+ New</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Available</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($drugs as $drug)
                    <tr>
                        <td scope="row">{{ $drug->drug_id }}</td>
                        <td>{{ $drug->name }}</td>
                        <td>{{ $drug->drug_code }}</td>
                        <td>{{ ($drug->is_active) ? 'Yes' : 'No' }}</td>
                        <td><a href="{{ route('drugs.edit', $drug) }}">View</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection