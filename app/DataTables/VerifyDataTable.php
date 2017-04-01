<?php

namespace App\DataTables;

use App\Customer;
use App\User;
use Yajra\Datatables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class VerifyDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'path.to.action.view')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Customer::whereHas('verify',function($query)  {
            $query->where('verify_by', Auth::user()->id)->where('status','0');
        });

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data'=>'id', 'title'=>'序号'],
            ['data'=>'name', 'title'=>'姓名'],
            ['data'=>'phone', 'title'=>'手机号'],
            ['data'=>'sex', 'title'=>'性别'],
            ['data'=>'created_at', 'title'=>'申请时间'],
            ['data'=>'updated_at', 'title'=>'获取时间'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'verifydatatables_' . time();
    }
}
