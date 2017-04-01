<?php

namespace App\Http\Controllers\Manager;

use App\Customer;
use App\Http\Traits\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ManagerDataTable\CustomersDataTable;

class CustomersController extends Controller
{
    public function index(CustomersDataTable $dataTable)
    {
        return $dataTable->render('users');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        return Customer::create(
            $request->all()
        );
    }

    public function destroy($id)
    {
        Customer::find($id)->destory();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }
}

