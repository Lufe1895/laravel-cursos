@extends('layouts.panel')

@section('content')
    <edit-status id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-status>
@endsection