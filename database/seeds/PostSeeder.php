<?php

use App\Domain\Models\Collections\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 10)->create();
    }
}
