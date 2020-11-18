@extends('layouts.form')

@section('card')

@component('components.card')

@slot('title')
@lang('Ajouter une matière')
@endslot

<form method="POST" action="{{ route('matiere.store') }}">
    {{ csrf_field() }}

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
