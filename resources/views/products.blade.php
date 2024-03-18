@extends('layout')

@section('content')

<products :products="{{ json_encode(array_values($products)) }}"></products>

@endsection
