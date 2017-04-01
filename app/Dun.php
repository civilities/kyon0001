<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dun
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Dun whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dun whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Dun whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Dun extends Model
{
    /** 与还款 多对一关系 */
    public function belongsToRepayment(){
        return $this->belongsTo('App\Repayment');
    }
}
