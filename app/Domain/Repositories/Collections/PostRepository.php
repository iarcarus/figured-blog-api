<?php

namespace App\Domain\Repositories\Collections;

use App\Domain\Models\Collections\Post;

class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }
}
