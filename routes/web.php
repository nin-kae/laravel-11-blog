<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaticPagesController;
use Illuminate\Support\Facades\Route;

// 静态页面
Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');

// 注册
Route::get('signup', [UsersController::class, 'create'])->name('signup');
Route::post('signup', [UsersController::class, 'store'])->name('signup.store');

// 用户资源
Route::resource('users', UsersController::class);
// GET|HEAD   users ............... users.index › UsersController@index 用户列表
// POST       users ............... users.store › UsersController@store 新增用户
// GET|HEAD   users/create ...... users.create › UsersController@create 新增用户表单
// GET|HEAD   users/{user} .......... users.show › UsersController@show 用户详情
// PUT|PATCH  users/{user} ...... users.update › UsersController@update 用户更新
// DELETE     users/{user} .... users.destroy › UsersController@destroy 用户删除
// GET|HEAD   users/{user}/edit ..... users.edit › UsersController@edit 用户编辑表单

// 登录和退出登录
Route::get('login', [SessionsController::class, 'create'])->name('login');
Route::post('login', [SessionsController::class, 'store'])->name('login');
Route::delete('logout', [SessionsController::class, 'destroy'])->name('logout');
