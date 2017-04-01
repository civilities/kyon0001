<?php

namespace App\Http\Controllers;

use App\DataTables\DunDataTable;
use App\Http\Traits\OverDueLoanTrait;
use Illuminate\Http\Request;

class OverdueController extends Controller
{


    public function index(DunDataTable $dataTable)
    {
        return $dataTable->render('users');
    }
}
