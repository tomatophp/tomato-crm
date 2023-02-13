<?php

namespace TomatoPHP\TomatoCrm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $loginBy
 * @property string $address
 * @property string $password
 * @property string $otp_code
 * @property string $otp_activated_at
 * @property string $last_login
 * @property string $agent
 * @property string $host
 * @property integer $attempts
 * @property boolean $login
 * @property boolean $activated
 * @property boolean $blocked
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountsMeta[] $accountsMetas
 * @property Activity[] $activities
 * @property Comment[] $comments
 * @property Location[] $locations
 */
class Account extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'username', 'loginBy', 'address', 'password', 'otp_code', 'otp_activated_at', 'last_login', 'agent', 'host', 'attempts', 'login', 'activated', 'blocked', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountsMetas()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\AccountsMeta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\Activity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function locations()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\Location');
    }
}
