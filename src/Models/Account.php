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
 * @property Model meta($key, $value)
 * @property Location[] $locations
 */
class Account extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
        'username',
        'loginBy',
        'address',
        'password',
        'otp_code',
        'otp_activated_at',
        'last_login',
        'agent',
        'host',
        'attempts',
        'login',
        'activated',
        'blocked',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'login' => 'boolean',
        'activated' => 'boolean',
        'blocked' => 'boolean',
    ];
    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
        'otp_activated_at',
        'last_login',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountsMetas()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\AccountsMeta');
    }

    /**
     * @param string $key
     * @param string|null $value
     * @return Model|string
     */
    public function meta(string $key, string|null $value=null): Model|string
    {
        if($value){
            return $this->accountsMetas()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->accountsMetas()->where('key', $key)->first()?->value;
        }
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
