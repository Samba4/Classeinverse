<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, User $userprofile)
    {
        return $user->id === $userprofile->id;
    }
}
