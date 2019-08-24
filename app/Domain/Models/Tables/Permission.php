<?php

namespace App\Domain\Models\Tables;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 * @property string permission
 * @property string description
 * @property Collection roles
 */
class Permission extends BaseModel
{
    public $table = 'permissions';

    protected $fillable = [
        'permission',
        'description'
    ];

    public function rules()
    {
        return [
            'permission'  => 'required',
            'description' => 'nullable'
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_x_permissions', 'permission_id', 'role_id');
    }
}
