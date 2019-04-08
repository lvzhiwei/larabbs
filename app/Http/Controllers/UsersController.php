<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // 注册表单
    public function create()
    {
        return view('users.create');
    }

    // 展示
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 注册提交
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        return;
    }
}
