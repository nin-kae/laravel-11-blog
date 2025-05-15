<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    /**
     * SessionsController constructor.
     *
     * This constructor applies middleware to the controller methods.
     * - guest: Only guests can access the login page.
     * - auth: Only authenticated users can access certain methods.
     */
    public function __construct()
    {
        // Only guests can access the login page
        // If the user is authenticated, they will be redirected to the home page
        // The 'guest' middleware checks if the user is not authenticated
        $this->middleware('guest')->only('create');
    }

    /**
     * Show the login form.
     *
     * @return View
     */
    public function create(): View
    {
        return view('sessions.create');
    }

    /**
     * Log the user in.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        // auth()->attempt() will attempt to log in the user with the given credentials.
        // redirect()->intended($fallback) will redirect to the intended URL if it exists, otherwise it will redirect to the fallback URL.
        if(auth()->attempt($credentials, $request->has('remember'))) {
            if (auth()->user()->activated) {
                $request->session()->regenerate();
                $fallback = route('users.show', auth()->user());
                return redirect()->intended($fallback)->with('success', 'Logged in successfully.');
            }
            auth()->logout();
            return redirect()->route('home')->with('warning', 'Your account is not activated, please check your email.');
        }

        return back()->withInput()->with('danger', 'Invalid credentials.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('login')->with('success', 'Logged out successfully');
    }
}
