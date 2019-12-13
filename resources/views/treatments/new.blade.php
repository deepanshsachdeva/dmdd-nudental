@extends('layouts.app')
@section ('title' , 'Create Treatment')
@section ('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-10">
            <h1>Create treatment for appointment #NU{{ $appointment->appointment_id }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('treatments.index', $appointment) }}" class="btn btn-secondary" role="button">&larr; Back</a>
        </div>
    </div>
    @if($errors->any())
    <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
    @endif
    <div class="row">
        <div class="col-6">
            <form action="{{ route('treatments.new', $appointment) }}" method="post">
                @csrf
                <div class="form-group col">
                    <label>Name</label>
                    <select class="form-control" name="treatment_catalogue">
                        <option value="">--- Select Name ---</option>
                        @foreach($treatment_catalogue as $treatment_item)
                        <option value="{{$treatment_item->treatment_catalogue_id}}" @if(old('treatment_catalogue') == $treatment_item->treatment_catalogue_id) selected @endif>{{ $treatment_item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label>Tooth</label>
                    <select class="form-control" name="tooth">
                        <option value="">--- Select Tooth ---</option>
                        @foreach($teeth as $tooth)
                        <option value="{{ $tooth->tooth_id }}" @if(old('tooth') == $tooth->tooth_id) selected @endif>{{ $tooth->tooth_code }} ({{ $tooth->tooth_type }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label>Surface</label>
                    <select class="form-control" name="surface">
                        <option value="">--- Select Surface ---</option>
                        @foreach($surfaces as $surface)
                        <option value="{{ $surface->surface_id }}" @if(old('surface') == $surface->surface_id) selected @endif>{{ $surface->surface_code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class = "form-group col">
                    <label> Comment</label>
                    <textarea class="form-control" rows="3" name="comment"></textarea>
                </div>  
                <div class="form-group col">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

