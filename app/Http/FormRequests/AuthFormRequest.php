<?php

namespace App\Http\FormRequests;

class AuthFormRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->onDefault();

    }

    public function onDefault()
    {
        return [
            'email'    => 'required',
            'password' => 'required'
        ];
    }
}
