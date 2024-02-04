<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'surname' => ['nullable'],
            'age' => ['nullable'],
            'photo' => ['nullable'],
            'password' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
