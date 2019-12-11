@extends('layouts.app')
@section('title', 'Drugs')
@section('content')


<div class="container">
    <div class="row align-items-center m-5">
        <div class="col"></div>
        <div class="col-8">
            <h1>List of Drugs</h1>

            @if(session('info'))
            <h2>{{ session('info') }}</h2>
            @endif
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Available</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($drugs as $drug)
                    <tr>
                        <td scope="row">{{ $drug['drug_id'] }}</td>
                        <td><a href="{{route('drugs.find', $drug)}}">{{ $drug['name'] }}</a></td>
                        <td>{{ $drug['drug_code'] }}</td>
                        <td>{{ ($drug['is_active']) ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="{{route('drugs.new')}}" class="btn btn-primary" role="button">+ New</a>
        </div>
        <div class="col"></div>
    </div>
</div>

@endsection