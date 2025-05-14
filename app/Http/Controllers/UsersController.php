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

    /**
     *  Show the registeration form
     *
     * @return View
     */
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

        // 创造一个新的用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        auth()->login($user); // 注册成功之后自动登录

        // Redirect to the user's profile with a session flash message.
        return redirect()->route('users.show', $user)->with('success', 'User created successfully.');;
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // 更新用户信息
        $request->validate([
            'name' => 'required|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update the user
        // $request->filled() checks if the field is present and not empty
        // $request->only() retrieves only the specified fields from the request
        $data = $request->only(['name', 'password']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);

        // Redirect to the user's profile with a session flash message.
        return redirect()->route('users.show', $user)->with('success', 'User updated successfully.');
    }

}
