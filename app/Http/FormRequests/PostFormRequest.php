<?php

namespace App\Http\FormRequests;

class PostFormRequest extends BaseFormRequest
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
            default:
                return [];
                break;
        }
    }

    public function onStore()
    {
        return [
            'post_form.tittle' => 'required',
            'post_form.text'   => 'required'
        ];
    }
}
