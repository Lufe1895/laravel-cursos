@extends('layouts.panel')

@section('content')
    <account-user id="{{ $id }}" apitoken="{{ Auth::user()->api_token }}" errors="{{ $errors }}"></account-user>
@endsection