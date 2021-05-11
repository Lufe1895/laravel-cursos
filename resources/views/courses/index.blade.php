@extends('layouts.panel')

@section('content')
    <index-course apitoken="{{ Auth::user()->api_token }}" admin="{{ auth()->user()->hasRole('admin') }}"></index-course>
@endsection