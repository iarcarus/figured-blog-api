<?php

namespace App\Domain\Models\Collections;

/**
 * @property string tittle
 * @property string short_text
 * @property string text
 * @property string tumblr
 */
class Post extends BaseModel
{
    public $collection = 'posts';

    protected $fillable = [
        'tittle',
        'short_text',
        'text',
        'tumblr',
    ];

    public function rules()
    {
        return [
            'tittle'     => 'required',
            'short_text' => 'required',
            'text'       => 'required',
            'tumblr'     => 'nullable',
        ];
    }
}
