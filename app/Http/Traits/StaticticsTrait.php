<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Customer;
Trait StaticticsTrait
{

    /** 返回统计结果 */
    public function data(Request $request)
    {
        $codes = $request->input('code');
        $time = time();

        return $this->datas($codes);
    }

    protected function Query($table, $time=null, $manager=null)
    {

        $query = Customer::from($table)->when($time, function($query) use ($time){
            return is_array($time) ?  $query->whereBetween('created_at',$time)
                :  $query->whereDate('created_at',$time);
        })->when($manager, function($query) use ($manager){
            return $query->whereHas('verify',function($query) use ($manager){
               $query->where('verify_by', $manager);
            });
        });

        return  $query;
    }

    public function datas($codes, $time=[],$manager){

        $codes = is_array($codes) ?:  explode(',', $codes);

        foreach ($codes as $code){
            switch ($code) {
                case 0 : //申请人数
                    $res[$code] = $this->Query('customers', $time, $manager)->count(); break;
                case 1 : //待审核人数
                    $res[$code] = $this->Query('customers', $time, $manager)->doesntHave('verify')->count(); break;
                case 2 : //通过人数
                    $res[$code] = $this->Query('customers', $time, $manager)->whereHas('verify',function($query){
                        $query->where('status',2);
                    })->count(); break;
                case 3 : //放款人数, 放款次数, 放款金额
                    $res[$code] = $this->Query('loans', $time, $manager)->selectRaw('count(distinct customer_id) as num, count(*) as times, sum(amount) as amount')->first()->toArray(); break;

                //todo :: 以下SQL需要修改为对应数据库新表的SQL
                case 4 : //延期人数, 延期金额, 延期费用
                    $res[$code] = $this->Query('loans', $time, $manager)->where('status',2)->selectRaw('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->get(); break;
                case 5 : //分期人数, 分期金额, 分期费用
                    $res[$code] = $this->Query('loans', $time, $manager)->where('status',4)->selectRaw('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->get(); break;
                case 6 : //逾期人数, 逾期金额, 逾期费用
                    $res[$code] =  DB::table('view_overdue_loans')->where('overdue_days','>',1)->select('count(id) as num ,sum(amount) as amount, sum(fee) as fee')->get(); break;
                case 7 : //参与推荐人数, 被推荐人数, 推荐佣金
                    //todo :: 功能完成
                case 8 : //逾期率相关
                    $res[$code] = DB::raw();
            }
        }

        return $res;
    }
}
