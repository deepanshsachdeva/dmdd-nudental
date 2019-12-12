@extends('layouts.app')
@section ('title' , 'Create Treatment')
@section ('content')
<div class="container">
    <div class="row">
        <div class="col-10">
            <h1>Create treatment for appointment #NU{{ $appointment->appointment_id }}</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('treatments.index', $appointment) }}" class="btn btn-secondary" role="button">&larr; Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form action="{{ route('treatments.new', $appointment) }}" method="post">
                <div class="form-group col">
                    <label>Name</label>
                    <select class="form-control" name="treatment_catalogue">
                        <option value="">--- Select Name ---</option>
                        @foreach($treatment_catalogue as $treatment_item)
                        <option value="{{$treatment_item->treatment_catalogue_id}}">{{ $treatment_item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label>Tooth</label>
                    <select class="form-control" name="tooth">
                        <option value="">--- Select Tooth ---</option>
                        @foreach($teeth as $tooth)
                        <option value="{{ $tooth->tooth_id }}">{{ $tooth->tooth_code }} ({{ $tooth->tooth_type }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label>Surface</label>
                    <select class="form-control" name="surface">
                        <option value="">--- Select Surface ---</option>
                        @foreach($surfaces as $surface)
                        <option value="{{ $surface->surface_id }}">{{ $surface->surface_code }}</option>
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

