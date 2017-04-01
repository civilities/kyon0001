<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\LoanDataTable;
use App\Http\Traits\PotentialCustomerTrait;
use App\Loan;
use Illuminate\Http\Request;
use App\Http\Requests\LoanRequest;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{

    use PotentialCustomerTrait;

    public function index(LoanDataTable $dataTable)
    {
        return $dataTable->render('backstage.loan.loan');
    }

    /** 操作放款, 续借 */
    public function store(Request $request)
    {
        Validator::make($data = $request->all(),[
            'id'=>'required|int|',
            'amount'=>'required|int',
            'out_time'=>'required|date',
            'back_time'=>'required|date|after:'.$request->input('out_time')
        ])->validate();

        $id = Customer::findOrFail($data['id']);

        if( Loan::where('customer_id',$data['id'])->count() == 0 or in_array($data['id'], $this->getIds())){
            return $id->loan()->Create([
                'User_id'=> $request->user()->id,
                'amount' => $data['amount'],
                'out_time' => $data['out_time'],
                'back_time' => $data['back_time'],
                'remain' => $data['amount'],
            ]);
        }
        return '该用户尚有未结清的借款记录';
    }

    /** 操作暂不放款 //todo :: 功能暂时被弃用?.*/
    public function noLoan(Request $request, $id){
//        Customer::find($id)->update(['status'=>3]);
    }

    //todo 接收续借申请 :: 先完成其他功能
}
