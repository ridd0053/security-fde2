<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function edit(User $user)
    {
        // If user is administrator, then can edit any user
        if ($user->isAdmin()) {
            return true;
        }

        // Check if user is the post author
        if (Auth::user()->id === $user->id) {
            return true;
        }

        return false;
    }
}
