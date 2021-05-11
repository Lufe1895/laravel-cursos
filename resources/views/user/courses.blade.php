@extends('layouts.panel')

@section('content')
    <courses-user apitoken="{{ Auth::user()->api_token }}" id="{{ $id }}"></courses-user>
@endsection