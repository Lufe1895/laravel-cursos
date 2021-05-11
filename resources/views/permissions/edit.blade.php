@extends('layouts.panel')

@section('content')
    <edit-permissions id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-permissions>
@endsection