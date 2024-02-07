<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => ['required', 'integer','unique:cars,client_id'],
            'number' => ['required'],
            'model' => ['required'],
            'name' => ['required'],
            'cooler' => ['required'],
            'year' => ['nullable'],
            'type' => ['required'],
            'photo' => ['nullable'],
            'is_comfort' => ['boolean','nullable'],
            'smoke' => ['boolean','nullable'],
            'conversation' => ['boolean','nullable'],
            'animals' => ['boolean','nullable'],
            'music' => ['boolean','nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
