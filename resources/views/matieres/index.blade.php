@extends('layouts.form')

@section('card')

@component('components.card')

@slot('title')
@lang('Gestion des matières')
@endslot


<table class="table table-dark text-white">
    <tbody>
        @foreach($matieres as $matiere)
        <tr>
            <td>{{ $matiere->name }}</td>
            <td>
                <a type="button" href="{{ route('matiere.destroy', $matiere->id) }}"
                    class="btn btn-danger btn-sm pull-right invisible" data-toggle="tooltip"
                    title="@lang('Supprimer la matière') {{ $matiere->name }}"><i class="fas fa-trash fa-lg"></i></a>
                <a type="button" href="{{ route('matiere.edit', $matiere->id) }}"
                    class="btn btn-warning btn-sm pull-right mr-2 invisible" data-toggle="tooltip"
                    title="@lang('Modifier la matière') {{ $matiere->name }}"><i class="fas fa-edit fa-lg"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endcomponent

@endsection

@section('script')

<script>
    $(() => {
            $('a').removeClass('invisible')
        })
</script>

@include('partials.script-delete', ['text' => __('Vraiment supprimer cette matière ?'), 'return' => 'removeTr'])

@endsection
