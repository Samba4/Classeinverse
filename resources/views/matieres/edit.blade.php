@extends('layouts.form')

@section('card')

@component('components.card')

@slot('title')
@lang('Modifier une matière')
@endslot

<form method="POST" action="{{ route('matiere.update', $matiere->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('partials.form-group', [
    'title' => __('Nom'),
    'type' => 'text',
    'name' => 'name',
    'value' => $matiere->name,
    'required' => true,
    ])

    @component('components.button')
    @lang('Envoyer')
    @endcomponent

</form>

@endcomponent

@endsection
