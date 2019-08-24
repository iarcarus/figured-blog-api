<?php

namespace App\Domain\Models\Collections;

use App\Domain\Models\Tables\User;

/**
 * @property string tittle
 * @property string short_text
 * @property string text
 * @property string tumblr
 * @property User author
 */
class Post extends BaseModel
{
    public $collection = 'posts';

    protected $fillable = [
        'tittle',
        'short_text',
        'text',
        'tumblr',
        'author_id'
    ];

    public function rules()
    {
        return [
            'tittle'     => 'required',
            'short_text' => 'required',
            'text'       => 'required',
//            'author_id'  => 'required|exists:users,id',
            'tumblr'     => 'nullable',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
