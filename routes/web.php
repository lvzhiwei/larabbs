<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'StaticPagesController@home')->name('home'); // 首页
Route::get('/help', 'StaticPagesController@help')->name('help'); // 帮助
Route::get('/about', 'StaticPagesController@about')->name('about'); // 关于

Route::get('signup', 'UsersController@create')->name('signup'); // 注册表单
Route::resource('users', 'UsersController'); //资源路由, 包含了隐式路由绑定

// Session 控制器
Route::get('login', 'SessionController@create')->name('login'); //登录表单
Route::post('login', 'SessionController@store')->name('login'); //创建新会话 (登录)
Route::delete('logout', 'SessionController@destroy')->name('logout'); //销毁会话 (退出登录)


