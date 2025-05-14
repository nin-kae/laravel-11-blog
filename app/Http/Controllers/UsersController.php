<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
//    public function __construct()
//    {
//        //
//        $this->middleware('auth', [
//            'except' => ['show', 'create', 'store' ]
//        ]);
//
//        $this->middleware('auth', [
//            'only' => ['create', 'store']
//        ]);
//    }

    public function create(): View
    {
        return view('users.create');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {

        // 三个必须传的数据
        $request->validate([
            'name' => 'required|string|unique:users|max:50',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

//        auth()->login($user); // 注册成功之后自动登录

        return redirect()->route('users.show', $user)->with('success', 'User created successfully.');;
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // 更新用户信息
        $request->validate([
            'name' => 'required|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update the user
        $data = $request->only(['name', 'password']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }
    }

}
