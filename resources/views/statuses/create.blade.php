@extends('layouts.panel')

@section('content')
    <create-status apitoken="{{ Auth::user()->api_token }}"></create-status>
@endsection