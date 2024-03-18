@extends('layout')

@section('content')

<admin-layout>
    <admin-orders :orders="{{ json_encode(array_values($orders)) }}"></admin-orders>
</admin-layout>

@endsection
