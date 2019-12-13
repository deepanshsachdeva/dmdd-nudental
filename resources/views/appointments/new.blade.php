@extends('layouts.app')
@section ('title' , 'Create Appointment')
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

    @if($errors->any())
        <div class="alert alert-danger mt-3">{{$errors->first()}}</div>
    @endif

    <div class="row">
        <div class="col-6">
            <form action="{{ route('appointments.new') }}" method="post">
                @csrf
                <div class="form-group col">
                    <label>Provider</label>
                    <select class="form-control @error('provider') is-invalid @enderror" name="provider">
                        <option value="" selected>--- Select Provider ---</option>
                        @foreach($providers as $provider)
                        <option value="{{ $provider->provider_id }}"  @if(old('provider') == $provider->provider_id ) selected @endif>{{ $provider->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('provider'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provider') }}
                    </div>
                    @endif
                </div>
                <div class="form-group col">
                    <label>Patient</label>
                    <select class="form-control @error('patient') is-invalid @enderror" name="patient">
                        <option value="">--- Select Patient ---</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->patient_id }}" @if(old('patient') == $patient->patient_id ) selected @endif>{{ $patient->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                    @endif
                </div>
                <div class="form-group col">
                    <label>Location</label>
                    <select class="form-control @error('location') is-invalid @enderror" name="location">
                        <option value="">--- Select Location ---</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->room_id }}" @if(old('location') ==$location->room_id ) selected @endif>{{ $location->name }} ({{ $location->room_code }})</option>
                        @endforeach
                    </select>
                    @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                    @endif
                </div>
                <div class="form-group col">
                    <label>Start Date & Time:</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" autocomplete="off" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/>
                        @if($errors->has('start_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_date') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col">
                    <label>End Date & Time:</label>
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control datetimepicker-input @error('end_date') is-invalid @enderror" autocomplete="off" id="datetimepicker2" data-toggle="datetimepicker" data-target="#datetimepicker2"/>
                        @if($errors->has('end_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_date') }}
                        </div>
                        @endif
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

@push('scripts')
<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
            defaultDate: moment().second(0),
        });

        $('#datetimepicker2').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss",
            defaultDate: moment().second(0).add(30, 'm'),
        });
    });
</script>
@endpush
