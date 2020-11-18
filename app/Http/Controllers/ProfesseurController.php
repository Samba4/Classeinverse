<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use App\Http\Requests\ProfesseurRequest;
use App\Repositories\ProfesseurRepository;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    protected $repository;
    public function __construct(ProfesseurRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('ajax')->only('destroy');
    }
    public function store(ProfesseurRequest $request)
    {
        $this->repository->create($request->user(), $request->all());
        return back()->with('ok', __("Le professeur a bien été enregistré"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userProfesseurs = $this->repository->getProfesseurs($request->user());
        return view('professeurs.index', compact('userProfesseurs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professeurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Professeur $professeur)
    {
        return view('professeurs.edit', compact('professeur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfesseurRequest $request, Professeur $professeur)
    {
        $this->authorize('manage', $professeur);
        $professeur->update($request->all());
        return redirect()->route('professeur.index')->with('ok', __("Le professeur a bien été modifié"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professeur $professeur)
    {
        $this->authorize('manage', $professeur);
        $professeur->delete();
        return response()->json();
    }
}
