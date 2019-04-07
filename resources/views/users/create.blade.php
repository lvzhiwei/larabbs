@extends('layouts.default')
@section('title', '注册')
@section('content')
    <h1>注册账号</h1>
    <form action="{{ route('signup') }}" method="post">
        <p>用户名: <input type="text" placeholder="请输入用户名"></p>
        <p>密  码: <input type="text" placeholder="请输入密码"></p>
        <p>邮 箱: <input type="text" placeholder="请输入验证码"></p>
    </form>
@stop