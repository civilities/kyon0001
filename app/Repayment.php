<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    /** 与借款 多对一关系 */
    public function belongsToLoan(){
        return $this->belongsTo('App\Loan');
    }

    /** 与延期 一对多关系 */
    public function hasManyDelay(){
        return $this->hasMany('App\Delay');
    }

    /** 与分期 一对一关系 */
    public function hasOneInstallment(){
        return $this->hasOne('App\Installment');
    }

    /** 与逾期 一对多关系 */
    public function hasManyOverdue(){
        return $this->hasMany('App\Overdue');
    }

    /** 与催收 一对多关系 */
    public function hasManyDebt(){
        return $this->hasMany('App\Debt');
    }
}
