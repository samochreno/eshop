@extends('layout')

@section('content')

<sign-up :errors="{{ json_encode($errors->any() ? $errors->all() : []) }}"></sign-up>

@endsection
