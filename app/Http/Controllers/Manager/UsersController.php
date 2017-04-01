<?php

namespace App\Http\Controllers\Manager;

use App\DataTables\ManagerDataTable\UsersDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users');
    }
}
