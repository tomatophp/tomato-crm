<?php

namespace TomatoPHP\TomatoCrm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property string $type
 * @property mixed $log
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class Activity extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'type', 'log', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('TomatoPHP\TomatoCrm\Models\Account');
    }
}
