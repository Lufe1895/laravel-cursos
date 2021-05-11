@extends('layouts.panel')

@section('content')
    <index-status apitoken="{{ Auth::user()->api_token }}"></index-status>
@endsection