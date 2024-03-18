@extends('layout')

@section('content')

<auth-form
    :error="'{{ format($errors) }}'"
    :width="'800px'"
    :title="'Registration'"
    :submit-text="'Register'"
    :submit-url="'{{ route('register.process') }}'"
    :other-text="'Login'"
    :other-url="'{{ route('login') }}'"
>
    @csrf

    <div class="relative w-full h-full flex">
        <div class="flex-grow h-full flex-center flex-col mr-6">
            <legend class="m-2">Login info</legend>

            <input required
                type="email"
                name="email"
                placeholder="Email"
                autocomplete="email"
                class="input mb-4"
            >
            <input required
                type="password"
                name="password"
                placeholder="Password"
                autocomplete="new-password"
                class="input mb-4"
            >
            <input required
                type="password"
                name="password_confirmation"
                placeholder="Confirm password"
                autocomplete="new-password"
                class="input"
            >
        </div>

        <div class="absolute m-auto inset-0 w-[1px] h-full bg-detail-soft">
        </div>

        <div class="flex-grow h-full flex-center flex-col ml-6">
            <legend class="m-2">Personal info</legend>

            <input required autofocus
                type="text"
                name="first_name"
                placeholder="First name"
                autocomplete="given-name"
                maxlength="255"
                class="input mb-4"
            >
            <input required autofocus
                type="text"
                name="last_name"
                placeholder="Last name"
                autocomplete="family-name"
                maxlength="255"
                class="input"
            >
        </div>
    </div>
</auth-form>

@endsection
