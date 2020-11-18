<?php

namespace App\Repositories;

use App\Models\Matiere;

class MatiereRepository extends BaseRepository
{
    public function __construct(Matiere $matiere)
    {
        $this->model = $matiere;
    }
}
