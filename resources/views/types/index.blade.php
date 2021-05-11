@extends('layouts.panel')

@section('content')
    <index-tipos apitoken="{{ Auth::user()->api_token }}"></index-tipos>
@endsection