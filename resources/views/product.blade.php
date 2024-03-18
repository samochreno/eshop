@extends('layout')

@section('content')

<product :product="{{ json_encode($product) }}"></product>

@endsection
