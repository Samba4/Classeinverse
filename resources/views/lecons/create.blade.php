@extends('layouts.form')

@section('card')

@component('components.card')

@slot('title')
@lang('Ajouter un cours')
@endslot

<form method="POST" action="{{ route('lecon.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group{{ $errors->has('lecon') ? ' is-invalid' : '' }}">@lang('Cours')
        <div class="custom-file">
            <input type="file" id="lecon" name="lecon"
                class="{{ $errors->has('lecon') ? ' is-invalid ' : '' }}custom-file-input">
            <label class="custom-file-label" for="lecon">@lang('Insérer une image de ce cours...')</label>
            @if ($errors->has('lecon'))
            <div class="invalid-feedback">
                {{ $errors->first('lecon') }}
            </div>
            @endif
        </div>

        <img id="preview" class="img-fluid" src="#" alt="">
    </div>

    <div class="form-group">
        @isset($matieres)
        <label for="matiere_id">@lang('Matière')</label>
        <select id="matiere_id" name="matiere_id" class="form-control">
            @foreach($matieres as $matiere)
            <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
            @endforeach
        </select>
        @endisset
    </div>

    @include('partials.form-group', [
    'title' => __('Titre du cours'),
    'type' => 'text',
    'name' => 'titre',
    'required' => false,
    ])

    @include('partials.form-group', [
    'title' => __('Description du cours'),
    'type' => 'text',
    'name' => 'description',
    'required' => false,
    ])

    @component('components.button')
    @lang('Envoyer')
    @endcomponent

</form>

@endcomponent

@endsection

@section('script')

<script>
    $(() => {
            $('input[type="file"]').on('change', (e) => {
                let that = e.currentTarget
                if (that.files && that.files[0]) {
                    $(that).next('.custom-file-label').html(that.files[0].name)
                    let reader = new FileReader()
                    reader.onload = (e) => {
                        $('#preview').attr('src', e.target.result)
                    }
                    reader.readAsDataURL(that.files[0])
                }
            })
        })
</script>

@endsection
