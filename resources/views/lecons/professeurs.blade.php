@foreach($professeurs as $professeur)
<div class="form-check">
    <label class="form-check-label">
        <input class="form-check-input" name="professeurs[]" value="{{ $professeur->id }}" type="checkbox" @if
            ($professeur->lecons->contains('id', $lecon->id)) checked @endif
        >
        {{ $professeur->name }}
    </label>
</div>
@endforeach
