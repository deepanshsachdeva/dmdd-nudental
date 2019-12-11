@extends('layouts.app')
@section('title', 'Create New Drug')
@section('content')
<div class="container">
    <div class="row align-items-center m-5">
        <div class="col"></div>
        <div class="col-6">
            <h1 class="mb-4">Create Drug</h1>
            <p>Enter details:</p>
            <form action="{{ route('drugs.new') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" aria-describedby="nameHelp" autocomplete="off">
                    @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="codeInput">Code</label>
                    <input type="text" class="form-control  @error('code') is-invalid @enderror" id="codeInput" name="code" autocomplete="off">
                    @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                    @endif
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="availableCheck" name="active" value="1">
                    <label class="form-check-label" for="availableCheck">Available</label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            @if ($errors->any())
            <div class="alert alert-danger mt-3">Please check errors</div>
            @endif
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection