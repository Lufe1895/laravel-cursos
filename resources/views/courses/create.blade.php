@extends('layouts.panel')

@section('content')
    <create-course apitoken="{{ Auth::user()->api_token }}"></create-course>
@endsection