<?php

namespace App\Domain\Models\Tables;

use Illuminate\Support\Collection;

/**
 * @property integer id
 * @property string name
 * @property string slug
 * @property Collection permissions
 */
class Role extends BaseModel
{
    const ADMIN  = 'ADMINISTRADOR';
    const READER = 'READER';

    public $table = 'roles';

    protected $fillable = [
        'slug',
        'name'
    ];

    public function rules()
    {
        return [
            'slug' => 'required|unique:roles,slug,' . $this->id,
            'name' => 'required'
        ];
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_x_permissions', 'role_id', 'permission_id');
    }
}
