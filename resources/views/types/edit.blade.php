@extends('layouts.panel')

@section('content')
    <edit-type id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-type>
@endsection