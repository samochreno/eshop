@extends('layout')

@section('content')

<admin-layout>
    <admin-products :products="{{ json_encode(array_values($products)) }}"></admin-products>
</admin-layout>

<create-product></create-product>
<delete-product></delete-product>

@endsection
