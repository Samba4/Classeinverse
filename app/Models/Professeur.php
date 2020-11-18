<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NameSaving;

class Professeur extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    protected $dispatchesEvents = [
        'saving' => NameSaving::class,
    ];

    public function lecons()
    {
        return $this->belongsToMany(Lecon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
