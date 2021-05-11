@extends('layouts.panel')

@section('content')
    <create-roles apitoken="{{ Auth::user()->api_token }}"></create-roles>
@endsection