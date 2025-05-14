<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create(): View
    {
        return view('sessions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $fallbackUrl = url()->previous();
            return redirect()->route('users.show')->with('success', 'Logged in successfully');
        }

        return back()->withInput()->with('danger', 'Invalid credentials');

    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect()->route('users.show')->with('success', 'Logged out successfully');
    }
}
