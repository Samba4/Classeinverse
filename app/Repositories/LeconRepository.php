<?php

namespace App\Repositories;

use App\Models\Lecon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class LeconRepository
{
    /**
     * Store lecon.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store($request)
    {
        // Save lecon
        $path = $request->lecon->store('images/cours', 'public');

        // Save thumb
        $image = InterventionImage::make(public_path('storage/' . $path))->resize(250, 250);
        $image->save();

        // Save in base
        $lecon = new Lecon;
        $lecon->titre = $request->titre;
        $lecon->description = $request->description;
        $lecon->matiere_id = $request->matiere_id;
        $lecon->name = $path;
        $request->user()->lecons()->save($lecon);
    }

    /**
     * Get all lecons.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllLecons()
    {
        return $this->paginateAndRate(Lecon::latestWithUser());
    }

    /**
     * Get lecons for matiere.
     *
     * @param  string $slug
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeconsForMatiere($slug)
    {
        $query = Lecon::latestWithUser()->whereHas('matiere', function ($query) use ($slug) {
            $query->whereSlug($slug);
        });

        return $this->paginateAndRate($query);
    }

    /**
     * Get lecons for user.
     *
     * @param  integer $id
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeconsForUser($id)
    {
        $query = Lecon::latestWithUser()->whereHas('user', function ($query) use ($id) {
            $query->whereId($id);
        });

        return $this->paginateAndRate($query);
    }

    /**
     * Get lecons for professeur.
     *
     * @param  string $slug
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getLeconsForProfesseur($slug)
    {
        $query = Lecon::latestWithUser()->whereHas('professeurs', function ($query) use ($slug) {
            $query->whereSlug($slug);
        });

        return $this->paginateAndRate($query);
    }

    /**
     * Check if lecon is not in professeur.
     *
     * @param  \App\Models\Lecon
     * @param  \App\Models\Professeur
     * @return boolean
     */
    public function isNotInProfesseur($lecon, $professeur)
    {
        return $lecon->professeurs()->where('professeurs.id', $professeur->id)->doesntExist();
    }

    /**
     * Get all orphans lecons.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getOrphans()
    {
        return collect(Storage::files('lecons'))->transform(function ($item) {
            return basename($item);
        })->diff(Lecon::select('name')->pluck('name'));
    }

    /**
     * Destroy orphans lecons.
     *
     * @return void
     */
    public function destroyOrphans()
    {
        $orphans = $this->getOrphans();

        foreach ($orphans as $orphan) {
            Storage::delete([
                'image/' . $orphan,
                'thumbs/' . $orphan,
            ]);
        }
    }

    /**
     * Rate lecon.
     *
     * @param  \App\Models\User
     * @param  \App\Models\Lecon
     * @param  integer
     * @return boolean
     */
    public function rateLecon($user, $lecon, $value)
    {
        $rate = $lecon->users()->where('users.id', $user->id)->pluck('rating')->first();

        if ($rate) {
            if ($rate !== $value) {
                $lecon->users()->updateExistingPivot($user->id, ['rating' => $value]);
            }
        } else {
            $lecon->users()->attach($user->id, ['rating' => $value]);
        }

        return $rate;
    }

    /**
     * Paginate and rate.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateAndRate($query)
    {
        $lecons = $query->paginate(config('app.pagination'));

        return $this->setRating($lecons);
    }

    /**
     * Set rating values for lecons.
     *
     * @param  \Illuminate\Pagination\LengthAwarePaginator
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function setRating($lecons)
    {
        $lecons->transform(function ($lecon) {
            $this->setLeconRate($lecon);
            return $lecon;
        });

        return $lecons;
    }

    /**
     * Set lecon rate.
     *
     * @param  \Illuminate\Support\Collection
     * @return void
     */
    public function setLeconRate($lecon)
    {
        $number = $lecon->users->count();

        $lecon->rate = $number ? $lecon->users->pluck('pivot.rating')->sum() / $number : 0;
    }

    /**
     * Check is user is lecon owner.
     *
     * @param  \App\Models\User
     * @param  \App\Models\Lecon
     * @return boolean
     */
    public function isOwner($user, $lecon)
    {
        return $lecon->user()->where('users.id', $user->id)->exists();
    }
}
