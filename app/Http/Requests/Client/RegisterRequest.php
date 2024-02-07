<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone'=>'required',' unique:clients',
            'name'=>'required',
            'password'=>'required ',' confirmed',' string ',' max_digits:255 ',' min_digits:6',
            'password_confirmation'=>'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
