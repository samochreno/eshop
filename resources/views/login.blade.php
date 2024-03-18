@extends('layout')

@section('content')

<auth-form
    :error="'{{ format($errors) }}'"
    :width="'600px'"
    :title="'Login'"
    :submit-text="'Log in'"
    :submit-url="'{{ route('login.process') }}'"
    :other-text="'Registration'"
    :other-url="'{{ route('register') }}'"
>
    @csrf
    <input
        required autofocus
        type="email"
        name="email"
        placeholder="Email"
        autocomplete="email"
        maxlength="255"
        class="input mb-4"
    >
    <input
        required
        type="password"
        name="password"
        placeholder="Password"
        autocomplete="current-password"
        class="input"
    >
</auth-form>

@endsection
