<?php

namespace TomatoPHP\TomatoCrm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property integer $user_id
 * @property string $type
 * @property string $status
 * @property boolean $is_approved
 * @property string $is_approved_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountRequestMeta[] $accountRequestMetas
 * @property Account $account
 * @property User $user
 */
class AccountRequest extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'user_id', 'type', 'status', 'is_approved', 'is_approved_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountRequestMetas()
    {
        return $this->hasMany('TomatoPHP\TomatoCrm\Models\AccountRequestMeta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(config('tomato-crm.model'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
