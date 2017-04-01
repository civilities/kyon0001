<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">还款</h4>
</div>
<div class="modal-body">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">还款</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action='/dun/1' method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">还款金额</label>
                    <input type="text" class="form-control" name="amount" id="exampleInputEmail1" placeholder="输入花呗额度">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">放款金额</label>
                    <input type="text" class="form-control" name="amount" id="exampleInputEmail1" placeholder="输入放款金额">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">放款时间)</label>
                    <input type="text" class="form-control" name="out_time" id="exampleInputPassword1" placeholder="选择放款日期,默认为今天">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">还款时间</label>
                    <input type="text" class="form-control" name="back_time" id="exampleInputFile" placeholder="选择还款时间,默认为28天后">
                    {{--todo 完善--}}
                    <p class="help-block" id="loan_days">放款期限为28天</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                </div>
                <div>
                    <input type="hidden" name="_put">
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    <button type="button" class="btn btn-primary">Ok</button>
</div>