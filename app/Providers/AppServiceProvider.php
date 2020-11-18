<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Repositories\{MatiereRepository, ProfesseurRepository};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->admin;
        });

        Blade::if('adminOrOwner', function ($id) {
            return auth()->check() && (auth()->id() === $id || auth()->user()->admin);
        });

        Blade::if('maintenance', function () {
            return auth()->check() && auth()->user()->admin && app()->isDownForMaintenance();
        });

        if (request()->server("SCRIPT_NAME") !== 'artisan') {

            view()->share('matieres', resolve(MatiereRepository::class)->getAll());

            view()->composer('layouts.app', function ($view) {
                if (auth()->check()) {
                    $professeurs = resolve(ProfesseurRepository::class)->getByUser(auth()->id());
                    if ($professeurs->isNotEmpty()) {
                        $view->with('professeurs', $professeurs);
                    }
                }
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
