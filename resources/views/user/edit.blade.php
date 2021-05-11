@extends('layouts.panel')

@section('content')
    <edit-user id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}" alumno="{{ Auth::user()->hasRole('student') }}" errors="{{ $errors }}"></edit-user>
@endsection