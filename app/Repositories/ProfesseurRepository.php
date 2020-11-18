<?php

/**
 * Created by PhpStorm.
 * User: Maurice
 * Date: 25/08/2018
 * Time: 21:53
 */

namespace App\Repositories;

use App\Models\Professeur;

class ProfesseurRepository extends BaseRepository
{
    /**
     * Create a new ProfesseurRepository instance.
     *
     * @param  \App\Models\Professeur $professeur
     */
    public function __construct(Professeur $professeur)
    {
        $this->model = $professeur;
    }

    /**
     * Create a new professeur.
     *
     * @param  \App\Models\User  $user
     * @param  array  $inputs
     * @return void
     */
    public function create($user, array $inputs)
    {
        $user->professeurs()->create($inputs);
    }

    /**
     * Get professeurs for user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Support\Collection
     */
    public function getProfesseurs($user)
    {
        return $user->professeurs()->get();
    }

    /**
     * Get professeurs for user with lecons.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Support\Collection
     */
    public function getProfesseursWithLecons($user)
    {
        return $user->professeurs()->with('lecons')->get();
    }

    public function getAllProfesseurs()
    {
        return Professeur::all();
    }
}
