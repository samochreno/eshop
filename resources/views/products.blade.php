@extends('layout')

@section('content')

<product-grid :products="{{ json_encode(array_values($products)) }}"></product-grid>

@endsection
