<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DataTables\ManagerDataTable\UsersDataTable;
use Illuminate\Http\Request;
use Datatables;
use App\User;

class DatatablesController extends Controller
{
    //
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }

    public function modal($id, $modal)
    {

        $info = Customer::find($id);

        $info->last_loan = $info->loan()->latest('id')->first();

//        if(!empty($info->last_loan)){
//            switch($info->last_loan->status){
//                case null : return;
//                case 2 : $info->last_loan->detail = $info->last_loan->repayment()->hasManyDelay()->first(); break;
//                case 3 : $info->last_loan->detail = $info->last_loan->repayment()->hasOneInstallment(); break;
//                case 4 : $info->last_loan->detail = $info->last_loan->repayment()->hasManyOverdue(); break;
//                default: $info->last_loan->detail = null;
//            }
//        }

        $info->connecter = json_decode($info->connecter);
        \View::share('info',$info);
        return view('backstage.'.$modal.'.data');
    }

    public function operation($method,$id){

        $info = Customer::find($id)->loan();
        return view("backstage.dun.$method");
    }
}
