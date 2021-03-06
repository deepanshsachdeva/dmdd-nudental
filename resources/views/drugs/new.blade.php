@extends('layouts.app')
@section('title', 'Create New Drug')
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1 class="mb-4">Create Drug</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('drugs.index') }}" class="btn btn-secondary" role="button">&larr; Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p>Enter details:</p>
            <form action="{{ route('drugs.new') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameInput">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput" name="name" value="{{ old('name') }}" aria-describedby="nameHelp" autocomplete="off">
                    @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="codeInput">Code</label>
                    <input type="text" class="form-control  @error('code') is-invalid @enderror" id="codeInput" name="code" value="{{ old('code') }}" autocomplete="off">
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
    </div>
</div>
@endsection