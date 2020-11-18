<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfesseurRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->professeur ? ',' . $this->professeur->id : '';

        return $rules = [
            'name' => 'required|string|max:255|unique:professeurs,name' . $id,
        ];
    }
}
