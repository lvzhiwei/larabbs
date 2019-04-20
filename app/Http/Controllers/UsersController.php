<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // 构造方法进行中间件校验
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
        ]);

        // 只让未登录用户访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);

        session()->flash('success', '欢迎, 您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    // 用户编辑表单
    public function edit(User $user)
    {
        $this->authorize('is_owner', $user);
        return view('users.edit', compact('user'));
    }

    // 更新用户信息
    public function update(User $user, Request $request)
    {
        $this->authorize('is_owner', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password)
            $data['password'] = bcrypt($request->password);
        $user->update($data);

        session()->flash('success', '个人资料更新成功! ');

        return redirect()->route('users.show', $user);
    }

    // 用户列表
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    // 删除用户功能
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
    }
}
