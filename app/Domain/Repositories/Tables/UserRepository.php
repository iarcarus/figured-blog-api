<?php

namespace App\Domain\Repositories\Tables;

use App\Domain\Models\Tables\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }
}
