<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * User can only update self.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Only admin can destroy other users, but not self.
     *
     * @param User $user
     * @param User $model
     * @return Response
     */
    public function destroy(User $user, User $model): Response
    {
        return $user->is_admin && $user->id !== $model->id
            ? Response::allow()
            : Response::deny('You do not have permission to delete this user.');
    }

    /**
     *
     */
    public function follow(User $user, User $model): bool
    {
        return $user->id !== $model->id;
    }
}
