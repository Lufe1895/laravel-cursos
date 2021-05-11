@extends('layouts.panel')

@section('content')
    <create-user apitoken="{{ Auth::user()->api_token }}" errors="{{ $errors }}"></create-user>
@endsection