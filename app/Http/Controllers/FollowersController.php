<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    /**
     * FollowersController constructor.
     *
     * This constructor applies middleware to the controller methods.
     * - auth: Only authenticated users can access certain methods.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Follow a user.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        if (!auth()->user()->isFollowing($user->id)) {
            auth()->user()->follow($user->id);
        }

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Unfollow a user.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('follow', $user);

        if (auth()->user()->isFollowing($user->id)) {
            auth()->user()->unfollow($user);
        }

        return redirect()->route('users.show', $user->id);
    }
}
