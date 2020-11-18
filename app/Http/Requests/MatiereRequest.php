<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatiereRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->matiere ? ',' . $this->matiere->id : '';

        return $rules = [
            'name' => 'required|string|max:255|unique:matieres,name' . $id,
        ];
    }
}
