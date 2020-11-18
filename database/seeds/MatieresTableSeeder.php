<?php

use Illuminate\Database\Seeder;
use App\Models\Matiere;

class MatieresTableSeeder extends Seeder
{

    public function run()
    {
        Matiere::create([
            'name' => 'Culture générale et expression',
        ]);
        Matiere::create([
            'name' => 'Mathematiques',
        ]);
        Matiere::create([
            'name' => 'Informatique',
        ]);
        Matiere::create([
            'name' => 'Anglais',
        ]);
        Matiere::create([
            'name' => 'Economie management',
        ]);
        Matiere::create([
            'name' => 'Droit',
        ]);
    }
}
