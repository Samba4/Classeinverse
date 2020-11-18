<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Lecon extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('rating');
    }

    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class);
    }

    public function scopeLatestWithUser($query)
    {
        $user = auth()->user();

        return $query->with('user')->latest();
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
