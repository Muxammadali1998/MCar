<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'client_id' => ['required', 'integer'],
            'number' => ['required'],
            'model' => ['required'],
            'name' => ['required'],
            'cooler' => ['required'],
            'year' => ['nullable'],
            'type' => ['required'],
            'photo' => ['nullable'],
            'is_comfort' => ['boolean'],
            'smoke' => ['boolean'],
            'conversation' => ['boolean'],
            'animals' => ['boolean'],
            'music' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
