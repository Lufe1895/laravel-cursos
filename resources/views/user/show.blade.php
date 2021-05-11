@extends('layouts.panel')

@section('content')
    <show-user id="{{ $id }}" alumno="{{ Auth::user()->hasRole('student') }}"></show-user>
@endsection