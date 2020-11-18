<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class NotificationRepository
{
    public function deleteDuplicate($user, $lecon)
    {
        DB::table('notifications')
            ->whereNotifiableId($lecon->user->id)
            ->whereNull('read_at')
            ->where('data->lecon_id', $lecon->id)
            ->where('data->user', $user->id)
            ->delete();
    }
}
