@extends('layouts.panel')

@section('content')
    <show-course id="{{ $id }}" alumno="{{ auth()->user()->hasRole('student') }}" userid="{{ auth()->user()->id }}" subscribed="{{ $subscribed }}"></show-course>
@endsection