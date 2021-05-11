@extends('layouts.panel')

@section('content')
    <index-user apitoken="{{ Auth::user()->api_token }}"></index-user>
@endsection