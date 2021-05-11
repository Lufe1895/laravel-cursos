@extends('layouts.panel')

@section('content')
    <edit-course id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-course>
@endsection