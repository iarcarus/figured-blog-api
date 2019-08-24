<?php

use App\Domain\Models\Tables\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        factory(Role::class)->create(['slug' => Role::ADMIN, 'name' => 'Administrador']);
        factory(Role::class)->create(['slug' => Role::READER, 'name' => 'Reader']);
    }
}
