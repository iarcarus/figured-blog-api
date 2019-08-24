<?php

namespace App\Domain\Models\Tables;

use App\Domain\Components\Helpers\CpfHelper;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer id
 * @property string name
 * @property string email
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    public $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'last_access',
        'login_attempts',
    ];

    protected $hidden = [
        'password',
    ];

    public function rules()
    {
        return [
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email,' . $this->id . ',id',
            'last_access' => 'nullable',
            'role_id'     => 'required|exists:roles,id',
        ];
    }

    public function rulesAlterPassword()
    {
        return [
            'current_password' => 'required',
            'password'         => 'required|password',
        ];
    }

    public function rulesResetPassword()
    {
        return [
            'password_confirmation' => 'required|same:password',
            'password'              => 'required|password',
        ];
    }

    public function rulesForceResetPassword()
    {
        return [
            'email' => 'required|email',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isLoggedUser()
    {
        return is_null(logged_user()) ? false : logged_user()->id === $this->id;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
