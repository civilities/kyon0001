<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Overdue extends Model
{
    /** 与还款 多对一关系 */
    public function belongsToRepayment()
    {
        return $this->belongsTo('Repayment');
    }

    public function getGracePeriod(){
        return DB::table('view_overdue_loans')->where('overdue_days',1)->get();
    }

    public function getOverDue()
    {
        return DB::table('view_overdue_loans')->where('overdue_days','>',1)->get();
    }

    public function overdue()
    {
        
    }
}
