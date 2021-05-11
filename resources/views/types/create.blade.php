@extends('layouts.panel')

@section('content')
    <create-tipos apitoken="{{ Auth::user()->api_token }}"></create-tipos>
@endsection