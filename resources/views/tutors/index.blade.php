@extends('layouts.panel')

@section('content')
    <index-tutor apitoken="{{ Auth::user()->api_token }}"></index-tutor>
@endsection