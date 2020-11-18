<?php

namespace App\Listeners;

use App\Events\NameSaving as EventNameSaving;

class NameSaving
{
    public function handle(EventNameSaving $event)
    {
        $event->model->slug = str_slug($event->model->name, '-');
    }
}
