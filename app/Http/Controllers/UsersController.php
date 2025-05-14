<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     *
     * This constructor applies middleware to the controller methods.
     * - auth: Only authenticated users can access certain methods.
     * - guest: Only guests can access the registration page.
     */
    public function __construct()
    {
        // 只允许未认证的用户访问注册页面
        // 如果访问非 show, create, store 方法则需要认证, 会自动重定向到登录页面
        $this->middleware('auth')->except(['show', 'create', 'store']);

        // 只允许未认证的用户访问注册页面
        $this->middleware('guest')->only('create');
    }

    /**
     *  Show the registeration form
     *
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function create(User $user): View
    {
        // Check if the authenticated user is authorized to update the user
        // This will automatically check the UserPolicy for the update method
        // If the user is not authorized, it will throw a 403 Forbidden response
        $this->authorize('update', $user);
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
            $data = $request->only('name', 'password');
        }
        $user->update($data);

        // Redirect to the user's profile with a session flash message.
        return redirect()->route('users.show', $user)->with('success', 'User updated successfully.');
    }

}
