<?php
/**
 * Created by PhpStorm.
 * User: Kyon
 * Date: 2017/1/19
 * Time: 下午4:02
 */

namespace App\Http\Traits;
use App\DataTables\PotentialCustomerDataTable;
use DB;


trait PotentialCustomerTrait
{

    public function potentialCustomer(PotentialCustomerDataTable $dataTable)
    {
        return $dataTable->render('users');
    }

    public function getIds(){
        return DB::table('view_potential_customer')->pluck('id')->all();
    }

    public function getNum()
    {
        return DB::table('view_potential_customer')->count();
    }
}