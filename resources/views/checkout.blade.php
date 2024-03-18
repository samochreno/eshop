@extends('layout')

@section('content')

@php
$user = auth()->check() ? (new \App\Http\Resources\UserResource(auth()->user())) : null;
@endphp

<checkout
    :user="{{ $user ? json_encode($user) : 'null' }}"
    home-href="{{ route('home') }}"
    :errors="{{ json_encode($errors->any() ? $errors->all() : []) }}"
></checkout>

@endsection
