<?php

namespace App\Policies;

use App\Models\{User, Lecon};
use Illuminate\Auth\Access\HandlesAuthorization;

class LeconPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function manage(User $user, Lecon $lecon)
    {
        return $user->id === $lecon->user_id;
    }
}
