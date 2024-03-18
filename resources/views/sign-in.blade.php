@extends('layout')

@section('content')

<sign-in :errors="{{ json_encode($errors->any() ? $errors->all() : []) }}"></sign-in>

@endsection
