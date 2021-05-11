@extends('layouts.panel')

@section('content')
    <create-tutor apitoken="{{ Auth::user()->api_token }}"></create-tutor>
@endsection