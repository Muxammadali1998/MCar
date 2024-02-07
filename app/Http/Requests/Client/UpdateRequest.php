<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string','max:255'],
            'surname' => ['nullable','string','max:255'],
            'age' => ['nullable','integer', 'max_digits:3'],
            'phone'=>['string'],
            'photo' => ['nullable','file'],
            'password' => ['string','max:255','min:6'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
