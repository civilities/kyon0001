<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Loan;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function phone( ){


        $query = Loan::has('installment')->where('status',1)->with('customer','installment')->get();


        var_dump($query);
        debug($query);
    }

    public function connecter(){
    }

}
