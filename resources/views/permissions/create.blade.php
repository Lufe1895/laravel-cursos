@extends('layouts.panel')

@section('content')
    <create-permissions apitoken="{{ Auth::user()->api_token }}"></create-permissions>
@endsection