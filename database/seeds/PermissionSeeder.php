<?php

use App\Domain\Components\Enumerators\Permissions;
use App\Domain\Models\Tables\Permission;
use App\Domain\Models\Tables\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [];

        $permissions[] = factory(Permission::class)->create([
            'permission'  => Permissions::WEB_BLOG_INDEX,
            'description' => 'Permission to access the list of posts.'
        ]);

        $permissions[] = factory(Permission::class)->create([
            'permission'  => Permissions::WEB_BLOG_SHOW,
            'description' => 'Permission to access an item of post list.'
        ]);

        foreach ($permissions as $permission) {
            Role::where('slug', Role::READER)->first()->permissions()->attach($permission->id);
        }

        factory(Permission::class)->create([
            'permission'  => Permissions::WEB_BLOG_CREATE,
            'description' => 'Permission to create a post.'
        ]);

        factory(Permission::class)->create([
            'permission'  => Permissions::API_BLOG_STORE,
            'description' => 'Permission to store a post.'
        ]);


        factory(Permission::class)->create([
            'permission'  => Permissions::WEB_BLOG_EDIT,
            'description' => 'Permission to edit a post.'
        ]);

        factory(Permission::class)->create([
            'permission'  => Permissions::API_BLOG_UPDATE,
            'description' => 'Permission to perform an update in a post.'
        ]);

        factory(Permission::class)->create([
            'permission'  => Permissions::WEB_BLOG_DESTROY,
            'description' => 'Permission to delete a post.'
        ]);

        foreach ($permissions as $permission) {
            Role::where('slug', Role::ADMIN)->first()->permissions()->attach($permission->id);
        }
    }
}
