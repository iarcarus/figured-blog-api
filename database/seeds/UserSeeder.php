<?php

use App\Domain\Models\Tables\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name'     => 'Adminstrador',
            'password' => bcrypt('Figured@2019'),
            'email'    => 'administrador@figured.com',
            'role_id'  => 1
        ]);

        factory(User::class)->create([
            'name'     => 'Sidão Oliveira',
            'password' => bcrypt('Figured@2019'),
            'email'    => 'sidao@figured.com',
            'role_id'  => 2
        ]);
    }
}
