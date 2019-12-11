@extends('layouts.app')
@section ('title' , 'Treatments')
@section ('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Treatments</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('treatments.new') }}" class="btn btn-primary" role="button">+ New</a>
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

                    <tr>
                        <td scope="row"></td>
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
