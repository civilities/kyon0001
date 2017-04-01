<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Delay
 *
 * @property int $id
 * @property int $list_loans_id
 * @property int $days
 * @property string $begin_date
 * @property string $end_date
 * @property string $comment
 * @property int $createBy
 * @property int $fee
 * @property int $way
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereListLoansId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereBeginDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereCreateBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereWay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Delay whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Delay extends Model
{
    /** 与还款表 多对一关系 */
    public function belongsToRepayment(){
        return $this->belongsTo('App\Repayment');
    }
}
