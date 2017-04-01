@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$data[1]}}</h3>

                    <p>未被分配客户数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">
                    今日已获取{{$data[0]}}名客户<i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$data[2]}}</h3>

                    <p>今日通过客户数</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer" id="aaa">
                    查看已通过客户列表 <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$data_y[1]}}</h3>

                    <p>昨日通过客户数</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
                <a href="#" class="small-box-footer">
                    昨日共获取{{$data_y[0]}}名客户 <i class="fa fa-arrow-circle-right"></i>
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
        @endsection

        @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        <script src="/vendor/datatables/buttons.server-side.js"></script>
        {!! $dataTable->scripts() !!}
        <script>
            $(document).ready(function() {
                var table = $('#users-table').DataTable();
                $('#users-table tbody').on( 'click', 'tr', function () {
                    var id = table.row( this ).data().id;
                    $('#detailModal').modal({
                        'remote': '/modal/'+ id +'/verify'
                    });
                });
                $("#detailModal").on("hidden.bs.modal", function() {
                    $(this).removeData("bs.modal");
                });

                $('#aaa').click(function(){
                    alert('aaa');
                    table.ajax.reload();
                });
            } );
        </script>
@endpush

@section ('modal')
        <!-- Modal -->
            <div class="modal container fade " id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-content">
                        <!-- Modal Content -->
                </div><!-- /.modal-content -->
            </div>
            <!-- /.modal -->
@endsection

