<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    // 登录表单
    public function create()
    {
        return view('sessions.create');
    }

    // 登录校验
    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials))
        {
            // 登录成功的相关操作
            session()->flash('success', '欢迎回来!');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            // 登录失败的相关操作
            session()->flash('danger', '很抱歉, 您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }
    }
}
