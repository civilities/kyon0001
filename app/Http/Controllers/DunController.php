<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Dun;
use App\Loan;
use Illuminate\Http\Request;
use App\DataTables\DunDataTable;
use Illuminate\Support\Facades\Validator;

class DunController extends Controller
{
    public function index(DunDataTable $dataTable)
    {
        return $dataTable->render('backstage.dun.dun');
    }


    public function operation($method,$id){

        $info = Customer::find($id)->loan()->latest()->first();
        return view("backstage.dun.$method", ['info'=>$info]);
    }

    /**
     * 催收相关操作
     *
     * 目前设计为 有逾期的情况下, 需先偿还逾期费用, 才可以办理延期分期
     * 延期时, 需立即提交延期费用
     * todo :: 分期时?
     *
     * @param Request $request
     * @param $id     !此处直接传入借款ID,
     * @return mixed
     */
    public function update(Request $request, $id){

        $this->validator($data = $request->all())->validate();

        $tar = Loan::find($id);

        switch($data['code']){
            case 1 : // 还款操作
                $remain = $tar->repayment()->latest('id')->value('remain');
                $data['operator'] = $request->user()->id;
                $data['remain'] = $remain - $data['amount'];
                $tar->repayment()->fill($data)->save();

                if ($data['remain'] == 0) {
                    $tar->update(['status'=>1]);
                }
                //todo  放入数据库事务中,
                break;
            case 2 : // 延期操作
                $tar->delay()->create($data); break;
            case 3 : // 分期操作
                $tar->installment()->create($data); break;

            case 0 : //催收操作
                $tar->updateOrCreate($data);
                //todo :: 完善催收;

        }
    }

    protected function validator(array $data){
        return Validator::make($data,[
            'code'=>'required|int|in:1,2,3',

            //还款及部分还款操作验证条件
            'amount'=>'required_if:code,1|int',
            'back_way'=>'required_if:code,1|int|between:1,4',
            'remain'=>'required_if:code,1|int',

            //延期操作验证条件
            'delay_days'=>'required_if:code,2|int|max:28',
            'delay_fee'=>'required_if:code,2|int',

            //逾期催收记录操作验证条件
            //todo ::补全条件

            //分期操作验证条件
            //todo ::补全条件
        ]);
    }
}
