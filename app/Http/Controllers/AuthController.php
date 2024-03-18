<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private static function isEmailRegistered($email)
    {
        return DB::table('users')
            ->where('email', $email)
            ->select('id')
            ->get()
            ->count() > 0;
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register()
    {
        $errors = [];

        validator(request()->all(), [
            'email' => ['required', 'email', 'min:3', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
            'first_name' => ['required', 'string', 'min:1', 'max:30'],
            'last_name' => ['required', 'string', 'min:1', 'max:30'],
        ])->validate();

        $email           = request()->get('email');
        $password        = request()->get('password');
        $confirmPassword = request()->get('password_confirmation');
        $firstName       = request()->get('first_name');
        $lastName        = request()->get('last_name');

        if (self::isEmailRegistered($email)) {
            $errors[] = "Email is already registered.";
        }

        if (count($errors) > 0) {
            return redirect()->back()->withErrors($errors);
        }

        User::create([
            'email' => $email,
            'password' => Hash::make($password),
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        if (auth()->attempt([ 'email' => $email, 'password' => $password ])) {
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login()
    {
        $errors = [];

        validator(request()->all(), [
            'email' => 'required|email|min:3|max:255',
            'password' => 'required',
        ])->validate();

        $email    = request()->get('email');
        $password = request()->get('password');

        if (auth()->attempt([ 'email' => $email, 'password' => $password ])) {
            return redirect()->route('home');
        }

        $errors[] = self::isEmailRegistered($email) ?
            'Wrong password.' :
            'Email is not registered.';

        return redirect()->back()->withErrors($errors);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
