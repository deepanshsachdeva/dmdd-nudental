@extends('layout')
@section('title', 'NUDental - Show Drug')
@section('content')
<a href="{{ route('drugs.index') }}">Back</a>
<h1>{{ $drug['name'] }}</h1>
<p>Code: {{ $drug['drug_code'] }}</p>
<p>Available: {{ ($drug['is_active']) ? 'Yes' : 'No' }}</p>
@endsection