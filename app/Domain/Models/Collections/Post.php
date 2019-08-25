<?php

namespace App\Domain\Models\Collections;

/**
 * @property string id
 * @property string tittle
 * @property string text
 * @property string tumblr
 * @property array author
 */
class Post extends BaseModel
{
    public $collection = 'posts';

    protected $fillable = [
        'tittle',
        'text',
        'author',
        'tumblr',
    ];

    public function rules()
    {
        return [
            'tittle' => 'required',
            'text'   => 'required',
            'author' => 'required',
            'tumblr' => 'nullable',
        ];
    }
}
