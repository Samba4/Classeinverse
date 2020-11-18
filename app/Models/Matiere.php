<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NameSaving;

class Matiere extends Model
{
    protected $dispatchesEvents = [
        'saving' => NameSaving::class,
    ];

    protected $fillable = [
        'name', 'slug',
    ];

    public function leçons()
    {
        return $this->hasMany(Lecon::class);
    }
}
