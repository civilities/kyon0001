<?php

namespace App\Http\Controllers\Manager;

use App\Customer;
use App\Http\Traits\OverDueLoanTrait;
use App\Http\Traits\PotentialCustomerTrait;
use App\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class StaticticsController extends Controller
{
    use PotentialCustomerTrait;

    /** 返回统计结果 */
    public function data(Request $request)
    {
        $codes = explode(',',$request->input('code'));
        $time = time();

        return $this->datas($codes);
    }

    protected function customerQuery($time=[])
    {
        return $query = Customer::when(!empty($time), function($query) use ($time){
            return $query->whereBetween('created_at',$time);
        });
    }

    protected function loanQuery(array $time=[])
    {
        return Loan::when(!empty($time), function($query) use ($time) {
            return $query->whereBetween('created_at', $time);
        });
    }

    public function datas(array $codes, $time=[]){
        foreach ($codes as $code){
            switch ($code) {
                case 1 : //申请人数
                    $res[$code] = $this->customerQuery()->count(); break;
                case 2 : //通过人数
                    $res[$code] = $this->customerQuery()->whereHas('verify',function($query){
                        $query->where('status',2);
                    })->count(); break;
                case 3 : //放款人数, 放款次数, 放款金额
                    $res[$code] = $this->loanQuery()->selectRaw('count(distinct customer_id) as num, count(*) as times, sum(amount) as amount')->first()->toArray(); break;

                //todo :: 以下SQL需要修改为对应数据库新表的SQL
                case 4 : //延期人数, 延期金额, 延期费用
                    $res[$code] = $this->loanQuery()->where('status',2)->selectRaw('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->first()->toArray(); break;
                case 5 : //分期人数, 分期金额, 分期费用
                    $res[$code] = $this->loanQuery()->where('status',4)->selectRaw('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->first()->toArray(); break;
                case 6 : //逾期人数, 逾期金额, 逾期费用
                    $res[$code] =  DB::table('view_overdue_loans')->where('overdue_days','>',1)->select('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->get(); break;
                case 7 : //参与推荐人数, 被推荐人数, 推荐佣金
                    //todo :: 功能完成
            }
        }
        return $res;
    }
}
