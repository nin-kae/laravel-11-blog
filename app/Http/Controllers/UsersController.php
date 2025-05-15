<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $this->middleware('auth')->except(['show', 'create', 'store', 'index', 'confirmEmail']);

        // 只允许未认证的用户访问注册页面
        $this->middleware('guest')->only('create');
    }

    /**
     * Show the list of users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate($this->perPage); // 22:04
        return view('users.index', compact('users'));
    }

    /**
     *  Show the registeration form
     *
     * @return View
     */
    public function create(): View
    {
        // Check if the authenticated user is authorized to update the user
        // This will automatically check the UserPolicy for the update method
        // If the user is not authorized, it will throw a 403 Forbidden response
        //$this->authorize('update', $user);
        return view('users.create');
    }

    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /**
     * Store a new user.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

        // Send email confirmation
        $this->sendEmailConfirmationTo($user);

        // Redirect to the user's profile with a session flash message.
        return redirect()->route('home')->with('success'. 'User created successfully.Please check your email to activate your account.');
    }

    /**
     * Show the edit user form.
     *
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function edit(User $user): View
    {
        // Check if the authenticated user is authorized to update the user
        // This will automatically check the UserPolicy for the update method
        // If the user is not authorized, it will throw a 403 Forbidden response
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

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

    /**
     * Delete the user.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('destroy', $user);

        // Delete the user
        $user->delete();

        // Redirect to the users list with a session flash message.
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Send an email confirmation to the user.
     *
     * @param $user
     * @return void
     */
    protected function sendEmailConfirmationTo($user): void
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'renhuaying0401@gmail.com';
        $name = 'NIN-KAE';
        $to = $user->email;
        $subject = "感谢注册 NIN-KAE 应用！请确认你的邮箱。";

        // Send the email
        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    /**
     * 验证用户邮箱, 修改用户信息为激活, 删除 activation_token
     *
     * @param $token
     * @return RedirectResponse
     */
    public function confirmEmail($token): RedirectResponse
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activation_token = null;
        $user->activated = true;
        $user->save();

        auth()->login($user);
        return redirect()->route('users.show', $user)->with('success', 'User activated successfully.');
    }
}
