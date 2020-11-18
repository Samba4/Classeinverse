<?php

namespace App\Http\Controllers;

use App\Repositories\LeconRepository;
use App\Repositories\ProfesseurRepository;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @param  \App\Repositories\LeconRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(LeconRepository $repository, ProfesseurRepository $professeurRepository)
    {
        $professeurs = $professeurRepository->getAllProfesseurs();
        $lecons = $repository->getAllLecons();

        return view('home', compact('lecons'));
    }


    /**
     * Change locale.
     *
     * @param  string $locale
     * @return \Illuminate\Http\Response
     */
    public function language(String $locale)
    {
        $locale = in_array($locale, config('app.locales')) ? $locale : config('app.fallback_locale');

        session(['locale' => $locale]);

        return back();
    }
}
