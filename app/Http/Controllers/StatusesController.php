<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * Destroy a status.
     *
     * @param Status $status
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();

        return redirect()->back()->with('success', 'Status deleted successfully!');
    }
}
