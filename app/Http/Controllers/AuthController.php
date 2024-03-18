<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignUp()
    {
        return view('sign-up');
    }

    public function signUp()
    {
        request()->validate([
            'email'                 => 'required|email|min:3|max:255|unique:users,email',
            'password'              => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
            'first_name'            => 'required|string|min:1|max:30',
            'last_name'             => 'required|string|min:1|max:30',

        ]);

        $email     = request()->get('email');
        $password  = request()->get('password');
        $firstName = request()->get('first_name');
        $lastName  = request()->get('last_name');

        User::create([
            'email'      => $email,
            'password'   => Hash::make($password),
            'first_name' => $firstName,
            'last_name'  => $lastName,
        ]);

        if (auth()->attempt([ 'email' => $email, 'password' => $password ])) {
            return redirect()->route('home');
        }

        return redirect()->route('sign-in');
    }

    public function showSignIn()
    {
        return view('sign-in');
    }

    public function signIn()
    {
        request()->validate([
            'email'    => 'required|email|min:3|max:255|exists:users,email',
            'password' => 'required|string',
        ]);

        $email    = request()->get('email');
        $password = request()->get('password');

        if (auth()->attempt([ 'email' => $email, 'password' => $password ])) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['Wrong password.']);
    }

    public function signOut()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
