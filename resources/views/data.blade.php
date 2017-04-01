<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">{{$info->name}}的详细信息</h4>
</div>
<div class="modal-body">
    {{--{!! $dataTable->table() !!}--}}
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$info->wx_pic or '/backstage/dist/img/user4-128x128.jpg'}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{$info->name}}</h3>

                    <p class="text-muted text-center">{{$info->wx_name or 000}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>芝麻分</b> <a class="pull-right">{{$info->zhimafen or 000}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>网龄</b> <a class="pull-right">{{$info->wangling or 000}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>客户类型</b> <a class="pull-right">{{$info->type or 'D'}}</a>
                        </li>
                    </ul>
                    {{--todo:: 这里超链接放置jxl数据接口--}}
                    <a href="" class="btn btn-primary btn-block"><b>Follow</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">相关信息</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> 工作单位</strong>

                    <p class="text-muted">
                        {{$info->company or 000}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> 手机定位</strong>

                    <p class="text-muted">{{$info->position or 000}}</p>

                    {{--<hr>--}}

                    {{--<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>--}}

                    {{--<p>--}}
                    {{--<span class="label label-danger">UI Design</span>--}}
                    {{--<span class="label label-success">Coding</span>--}}
                    {{--<span class="label label-info">Javascript</span>--}}
                    {{--<span class="label label-warning">PHP</span>--}}
                    {{--<span class="label label-primary">Node.js</span>--}}
                    {{--</p>--}}

                    {{--<hr>--}}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                    <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/backstage/dist/img/user1-128x128.jpg" alt="user image">
                                <span class="username">
                                  <a href="#">用户基本信息</a>
                                  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">申请时间&nbsp;{{$info->created_at}}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                姓名: 金龙
                                年龄: 27
                                Email: 4013597@qq.com
                                balabala
                            </p>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/backstage/dist/img/user7-128x128.jpg" alt="User Image">
                                <span class="username">
                                  <a href="#">联系人信息</a>
                                  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                父亲: 金龙1 18519120546
                                母亲: 金龙2 18519120546
                                其他信息balabala
                            </p>

                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/backstage/dist/img/user6-128x128.jpg" alt="User Image">
                                <span class="username">
                                  <a href="#">身份证图片</a>
                                  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">Posted 5 photos - 5 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row margin-bottom">
                                <div class="col-sm-6">
                                    <img class="img-responsive" src="/backstage/dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img class="img-responsive" src="/backstage/dist/img/photo2.png" alt="Photo">
                                            <br>
                                            <img class="img-responsive" src="/backstage/dist/img/photo3.jpg" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <img class="img-responsive" src="/backstage/dist/img/photo4.jpg" alt="Photo">
                                            <br>
                                            <img class="img-responsive" src="/backstage/dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
{{--                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/backstage/dist/img/user1-128x128.jpg" alt="user image">
                                <span class="username">
                                  <a href="#">操作信息</a>
                                  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                                </span>
                                <span class="description">操作信息&nbsp;{{$info->created_at}}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                最近一次借款信息: 借款时间 2016-12-12 12:12:12 借款金额 5000 etc..

                            </p>
                        </div>--}}
                        <!-- /.post -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->

                            <li class="time-label">
                                <span class="bg-yellow">
                                  2017-12-12 12:12:12
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-refresh bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">{{$info->LoanManager or '冯建涛'}}</a> 操作续借</h3>

                                    <div class="timeline-body">
                                        放款金额: 5000, 放款时间: 2016-12-12 12:12:12, 放款期限: 28天,
                                        还款时间: 2017-1-12 12:12:12,
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                            <li class="time-label">
                                <span class="bg-red">
                                  2017-12-12 12:12:12
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-warning bg-red"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">{{$info->DunManager or '张杰'}}</a> 第1次催收</h3>

                                    <div class="timeline-body">
                                        放款金额: 5000, 放款时间: 2016-12-12 12:12:12, 放款期限: 28天,
                                        还款时间: 2017-1-12 12:12:12,
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-blue">
                                  10 Feb. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">{{$info->loanManager or '冯建涛'}}</a> 首借放款</h3>

                                    <div class="timeline-body">
                                        放款金额: 5000, 放款时间: 2016-12-12 12:12:12, 放款期限: 28天,
                                        还款时间: 2017-1-12 12:12:12,
                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-primary btn-xs">Read more</a>
                                        <a class="btn btn-danger btn-xs">Delete</a>
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-green">
                                    {{$info->create_at or date('Y-m-d H:i:s', time())}}
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-green"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">{{$info->name}}</a> 提交了用户信息</h3>

                                    <div class="timeline-body">
                                        系统审核意见 : {{$this->sysAdvice or '年龄偏低(16)'}}
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="button" class="btn btn-danger verify" value="3">审核拒绝</button>
    <button type="button" class="btn btn-primary verify" value="2">审核通过</button>
</div>
