<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Album') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Professeur') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img width="16" height="16" alt="{{ session('locale') }}"
                        src="{!! asset('images/flags/' . session('locale') . '-flag.png') !!}" />
                </a>
                <div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
                    @foreach(config('app.locales') as $locale)
                    @if($locale != session('locale'))
                    <a class="dropdown-item" href="{{ route('language', $locale) }}">
                        <img width="32" height="32" alt="{{ session('locale') }}"
                            src="{!! asset('images/flags/' . $locale . '-flag.png') !!}" />
                    </a>
                    @endif
                    @endforeach
                </div>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                    @isset($matiere)
                        {{ currentRoute(route('matiere', $matiere->slug)) }}
                    @endisset
                    " href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        @lang('Matieres')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
                        @foreach($matieres as $matiere)
                        <a class="dropdown-item" href="{{ route('matiere', $matiere->slug) }}">{{ $matiere->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                                @isset($professeur)
                                    {{ currentRoute(route('professeur', $professeur->slug)) }}
                                @endisset
                                " href="#" id="navbarDropdownCat" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @lang('Professeurs')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownCat">
                        @foreach($professeurs as $professeur)
                        <a class="dropdown-item"
                            href="{{ route('professeur', $professeur->slug) }}">{{ $professeur->name }}</a>
                        @endforeach
                    </div>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ currentRoute(
                                        route('professeur.create'),
                                        route('lecon.create'),
                                        route('professeur.index')
                                    )}}" href="#" id="navbarDropdownGestProfesseur" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Cours')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownGestProfesseur">
                        <a class="dropdown-item" href="{{ route('lecon.create') }}">
                            <i class="fas fa-graduation-cap"></i> @lang('Ajouter un cours')
                        </a>
                        <a class="dropdown-item" href="{{ route('professeur.create') }}">
                            <i class="fas fa-user-tie"></i> @lang('Ajouter un professeur')
                        </a>
                        <a class="dropdown-item" href="{{ route('professeur.index') }}">
                            <i class="fas fa-users"></i> @lang('Gérer les professeurs')
                        </a>
                    </div>
                </li>
                @endauth
            </ul>
            <ul class="navbar-nav ml-auto">
                @admin
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ currentRoute(
                                                                        route('matiere.create'),
                                                                        route('matiere.index'),
                                                                        route('matiere.edit', request()->matiere?: 0),
                                                                        route('orphans.index'),
                                                                        route('maintenance.index'),
                                                                        route('user.index')
                                                                    )}}" href="#" id="navbarDropdownGestCat"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Support technique')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownGestCat">
                        <a class="dropdown-item" href="{{ route('matiere.create') }}">
                            <i class="fas fa-plus fa-lg"></i> @lang('Ajouter une matière')
                        </a>
                        <a class="dropdown-item" href="{{ route('matiere.index') }}">
                            <i class="fas fa-wrench fa-lg"></i> @lang('Gérer les matières')
                        </a>
                        <a class="dropdown-item" href="{{ route('orphans.index') }}">
                            <i class="fab fa-leanpub"></i> @lang('Cours annulées')
                        </a>
                        <a class="dropdown-item" href="{{ route('maintenance.index') }}">
                            <i class="fas fa-cogs fa-lg"></i> @lang('Mode maintenance')
                        </a>
                        <a class="dropdown-item" href="{{ route('user.index') }}">
                            <i class="fas fa-user-graduate"></i> @lang('Etudiants')
                        </a>
                    </div>
                </li>
                @endadmin
                @guest
                <li class="nav-item{{ currentRoute(route('login')) }}"><a class="nav-link"
                        href="{{ route('login') }}">@lang('Se connecter')</a></li>
                <li class="nav-item{{ currentRoute(route('register')) }}"><a class="nav-link"
                        href="{{ route('register') }}">@lang('S\'inscrire')</a></li>
                @else
                @maintenance
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('maintenance.index') }}" data-toggle="tooltip"
                        title="@lang('Mode maintenance')">
                        <span class="fas fa-exclamation-circle  fa-lg" style="color: red;">
                        </span>
                    </a>
                </li>
                @endmaintenance
                @unless(auth()->user()->unreadNotifications->isEmpty())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notification.index') }}">
                        <span class="fa-layers fa-fw">
                            <span style="color: yellow" class="fas fa-bell fa-lg" data-fa-transform="grow-2"></span>
                            <span class="fa-layers-text fa-inverse" data-fa-transform="shrink-4 up-2 left-1"
                                style="color: black; font-weight:900">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </span>
                    </a>
                </li>
                @endunless
                <li class="nav-item{{ currentRoute(
                            route('profile.edit', auth()->id()),
                            route('profile.show', auth()->id())
                        )}}">
                    <a class="nav-link" href="{{ route('profile.edit', auth()->id()) }}">@lang('Profil')</a>
                </li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" href="{{ route('logout') }}">@lang('Se déconnecter')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    @if (session('ok'))
    <div class="container">
        <div class="alert alert-dismissible alert-success fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    @endif

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
    <script>
        $(() => {
        $('#logout').click((e) => {
            e.preventDefault()
            $('#logout-form').submit()
        })
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>

</html>
