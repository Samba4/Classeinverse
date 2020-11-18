@extends('layouts.form')

@section('card')

@component('components.card')

@slot('title')
@lang('Ajouter un professeur')
@endslot

<form method="POST" action="{{ route('professeur.store') }}">
    @csrf

    @include('partials.form-group', [
    'title' => __('Nom'),
    'type' => 'text',
    'name' => 'name',
    'required' => true,
    ])

    @component('components.button')
    @lang('Ajouter')
    @endcomponent

</form>

@endcomponent

@endsection
