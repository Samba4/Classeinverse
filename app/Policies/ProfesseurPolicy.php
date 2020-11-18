<?php

namespace App\Policies;

use App\Models\{User, Professeur};
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfesseurPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->admin) {
            return true;
        }
    }

    public function manage(User $user, Professeur $professeur)
    {
        return $user->id === $professeur->user_id;
    }
}
