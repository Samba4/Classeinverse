<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserCreated
{
    use  SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
