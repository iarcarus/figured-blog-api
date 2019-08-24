<?php

namespace App\Http\FormRequests;

class UserFormRequest extends BaseFormRequest
{
    const ACTION_SHOW    = 'show';
    const ACTION_STORE   = 'store';
    const ACTION_UPDATE  = 'update';
    const ACTION_DESTROY = 'destroy';

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch (request()->route()->getActionMethod()) {
            case self::ACTION_STORE:
                return $this->onStore();
                break;
            case self::ACTION_UPDATE:
                return $this->onUpdate();
            default:
                return [];
                break;
        }
    }

    public function onStore()
    {
        return [
            'user_form.name'  => 'required',
            'user_form.email' => 'required',
        ];
    }

    public function onUpdate()
    {
        return [
            'user_form.email' => 'forbidden',
        ];
    }
}
