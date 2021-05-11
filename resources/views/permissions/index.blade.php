@extends('layouts.panel')

@section('content')
    <index-permissions apitoken="{{ Auth::user()->api_token }}"></index-permissions>
@endsection