@extends('layouts.panel')

@section('content')
    <courses-course apitoken="{{ Auth::user()->api_token }}" admin="{{ auth()->user()->hasRole('admin') }}"></courses-course>
@endsection