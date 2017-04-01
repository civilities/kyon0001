@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>

                    <p>待放款客户</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">
                    今日新增120名客户<i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>50</h3>

                    <p>已通过客户</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    查看已通过客户列表 <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>40</h3>

                    <p>昨日审核通过人数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">
                    昨日新增189名客户 <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>6.51</h3>

                    <p>本月逾期率</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                    总逾期率3.92 <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">待审核客户列表</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!!$dataTable->table(['id'=>'users-table', 'class'=>"table table-striped table-bordered table-hover dataTables-example dataTable"]) !!}
        </div>
    </div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css" >
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>

{!! $dataTable->scripts() !!}

<script>
    $(document).ready(function() {
        var table = $('#users-table').DataTable();
        $('#users-table tbody').on( 'click', 'tr', function () {
            $('#detailModal').modal(
                    {'remote': '/modal/'+ table.row( this ).data().id+'/dun'}
            );
        });
        $("#detailModal").on("hidden.bs.modal", function() {
            $(this).removeData("bs.modal");
        });

    } );
</script>
@endpush

@section ('modal')

    <div id="detailModal" class="modal container fade modal-info" tabindex="-1" style="display: none;">
        <div class="modal-content">
            {{--Modal Content--}}
        </div>
    </div>

    <div id="repayment" class="modal fade modal-danger" tabindex="-1" data-focus-on="input:first" style="display: none;">
        <div class="modal-content">

        </div>
    </div>

@endsection