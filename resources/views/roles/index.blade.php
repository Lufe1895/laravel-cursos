@extends('layouts.panel')

@section('content')
    <index-roles apitoken="{{ Auth::user()->api_token }}"></index-roles>
@endsection