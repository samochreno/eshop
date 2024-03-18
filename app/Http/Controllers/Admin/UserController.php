<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        return view('admin.users', [
            'users' => UserResource::collection(User::all())->resolve(),
        ]);
    }
}
