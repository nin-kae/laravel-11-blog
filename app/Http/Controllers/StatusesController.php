<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        auth()->user()->statuses()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Status posted successfully!');
    }

    public function destroy(Status $status)
    {

    }
}
