@extends('layouts.panel')

@section('content')
    <edit-roles id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-roles>
@endsection