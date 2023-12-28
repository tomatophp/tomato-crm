<?php

namespace TomatoPHP\TomatoCrm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $account_request_id
 * @property integer $model_id
 * @property string $model_type
 * @property string $key
 * @property mixed $value
 * @property boolean $is_approved
 * @property string $is_approved_at
 * @property string $created_at
 * @property string $updated_at
 * @property AccountRequest $accountRequest
 * @property User $user
 */
class AccountRequestMeta extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'account_request_id', 'model_id', 'model_type', 'key', 'value', 'is_approved', 'is_approved_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function accountRequest()
    {
        return $this->belongsTo('TomatoPHP\TomatoCrm\Models\AccountRequest');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
