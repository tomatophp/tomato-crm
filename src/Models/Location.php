<?php

namespace TomatoPHP\TomatoCrm\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $account_id
 * @property string $street
 * @property string $area
 * @property string $city
 * @property string $country
 * @property integer $home_number
 * @property integer $flat_number
 * @property integer $floor_number
 * @property string $mark
 * @property string $map_url
 * @property string $note
 * @property string $lat
 * @property string $lng
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 */
class Location extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['account_id', 'street', 'area', 'city', 'country', 'home_number', 'flat_number', 'floor_number', 'mark', 'map_url', 'note', 'lat', 'lng', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo('TomatoPHP\TomatoCrm\Models\Account');
    }
}
