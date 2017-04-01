<?php

namespace App\Http\Controllers\HomePage;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function create()
    {
        //
    }

    public function store($request)
    {

        Customer::create();
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function setType(Customer $customer)
    {
        if(empty($customer)){
            return false;
        }

        //系统直接拒绝掉芝麻分过低的客户 备注 芝麻分过低
        if(($customer->sex == 1 and $customer->zhimafen < 650) or ($customer->sex == 2 and $customer->zhimafen < 600)){
            //todo 完成这里
        }

        /** 系统综合判断客户情况 备注 {相应的审核参照}*/
        $comment = '';
        // 年龄
        if ($customer->age < 25) $comment .= '年龄偏低 ';
        if ($customer->age > 40) $comment .= '年龄偏高 ';
        if ($customer->sex == 1 and !in_array($customer->education,['大专','本科','本科以上'])) $comment .= '学历偏低 ';
        if (in_array(mb_substr($customer->hujidizhi,0,2), ['新疆','内蒙','西藏','辽宁','吉林','黑龙'])) $comment .= '敏感地域';
        if ($comment === '') {
            $comment = '系统初审通过';
        }else{
            return $this->where('id',$customer->id)->update(['type'=>'D', 'sysAdvice'=>$comment]);
        }

        if ($customer->sex == 1) {
            if ($customer->zhimafen >= 720) {
                $this->where('id',$customer->id)->update(['type'=>'A', 'sysAdvice'=>$comment]);
                return true;
            } elseif ($customer->zhimafen >= 700) {
                $this->where('id',$customer->id)->update(['type'=>'B', 'sysAdvice'=>$comment]);
                return true;
            } elseif ($customer->zhimafen >= 650) {
                $this->where('id',$customer->id)->update(['type'=>'C', 'sysAdvice'=>$comment]);
                return true;
            }
        } elseif ($customer->sex == 2) {
            if ($customer->zhimafen >= 700) {
                $this->where('id',$customer->id)->update(['type'=>'A', 'sysAdvice'=>$comment]);
                return true;
            } elseif ($customer->zhimafen >= 650) {
                $this->where('id',$customer->id)->update(['type'=>'B', 'sysAdvice'=>$comment]);
                return true;
            } elseif ($customer->zhimafen >= 600) {
                $this->where('id',$customer->id)->update(['type'=>'C', 'sysAdvice'=>$comment]);
                return true;
            }
        }else{
            return false;
        }
    }
}
