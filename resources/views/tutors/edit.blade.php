@extends('layouts.panel')

@section('content')
    <edit-tutor id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}"></edit-tutor>
@endsection