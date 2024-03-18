@extends('layout')

@section('content')

<admin-layout>
    <admin-users :users="{{ json_encode(array_values($users)) }}"></admin-users>
</admin-layout>

@endsection
