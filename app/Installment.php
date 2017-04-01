<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Installments
 *
 * @property int $id
 * @property int $loan_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Installments whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Installments whereLoanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Installments whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Installments whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Installments extends Model
{
    /** 与还款表 一对一关系 */
    public function belongsToRepayment(){
        return $this->belongsTo('App\Repayment');
    }
}
