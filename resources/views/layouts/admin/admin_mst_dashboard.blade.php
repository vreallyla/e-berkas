<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">


    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">


    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/sweetalert2/sweetalert2.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #divLoading
        {
            display : none;
        }
        #divLoading.show
        {
            display : block;
            position : fixed;
            z-index: 100;
            background-image : url('http://localhost:8000/images/loadingstyle/loadingscreen.gif');
            opacity : 0.4;
            background-repeat : no-repeat;
            background-position : center;
            left : 0;
            bottom : 0;
            right : 0;
            top : 0;
        }
        #loadinggif.show
        {
            left : 50%;
            top : 50%;
            position : absolute;
            z-index : 101;
            width : 32px;
            height : 32px;
            margin-left : -16px;
            margin-top : -16px;
        }
        div.content {
            width : 1000px;
            height : 1000px;
        }
    </style>

    <style>
    .tgl {
    position: relative;
    outline: 0;
    display: inline-block;
    cursor: pointer;
    user-select: none;
    margin: 0 0 5px 0;
    width: 100%;
    }

    .tgl,
    .tgl:after,
    .tgl:before,
    .tgl *,
    .tgl *:after,
    .tgl *:before,
    .tgl + .tgl-btn {
    box-sizing: border-box;
    }

    .tgl::selection,
    .tgl:after::selection,
    .tgl:before::selection,
    .tgl *::selection,
    .tgl *:after::selection,
    .tgl *:before::selection,
    .tgl + .tgl-btn::selection {
    background: none;
    }

    .tgl span {
    position: relative;
    display: block;
    height: 1.8em;
    line-height: 1.2em;
    overflow: hidden;
    font-weight: normal;
    text-align: center;
    border-radius: 2em;
    padding: 0.2em 1em;
    border: 1px solid #fafafa;
    box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.2), 0 2px 0 rgba(255, 255, 255, 0.7);
    transition: color 0.3s ease, padding 0.3s ease-in-out, background 0.3s ease-in-out;
    }

    .tgl span:before {
    position: relative;
    display: block;
    line-height: 1.3em;
    padding: 0 0.2em;
    font-size: 1em;
    }

    .tgl span:after {
    position: absolute;
    display: block;
    content: '';
    border-radius: 2em;
    width: 1.3em;
    height: 1.3em;
    margin-left: -1.45em;
    top: 0.2em;
    background: #FFFFFF;
    transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 0.97), background 0.3s ease-in-out;
    }

    .tgl input[type="checkbox"] {
    display: none !important;
    }

    .tgl input[type="checkbox"]:not(:checked) + span {
    background: #f85858;
    color: #FFFFFF;
    padding-left: 1.6em;
    padding-right: 0.4em;
    }

    .tgl input[type="checkbox"]:not(:checked) + span:before {
    content: attr(data-off);
    color: #FFFFFF;
    }

    .tgl input[type="checkbox"]:not(:checked) + span:after {
    background: #FFFFFF;
    left: 1.6em;
    }

    .tgl input[type="checkbox"]:checked + span {
    background: #00a65a;
    color: #FFFFFF;
    padding-left: 0.4em;
    padding-right: 1.6em;
    }

    .tgl input[type="checkbox"]:checked + span:before {
    content: attr(data-on);
    }

    .tgl input[type="checkbox"]:checked + span:after {
    background: #FFFFFF;
    left: 100%;
    }

    .tgl input[type="checkbox"]:disabled,
    .tgl input[type="checkbox"]:disabled + span,
    .tgl input[type="checkbox"]:read-only,
    .tgl input[type="checkbox"]:read-only + span {
    cursor: not-allowed;
    }

    .tgl-gray input[type="checkbox"]:not(:checked) + span {
    background: #dbdbdb;
    color: #999999;
    }

    .tgl-gray input[type="checkbox"]:not(:checked) + span:before {
    color: #999999;
    }

    .tgl-gray input[type="checkbox"]:not(:checked) + span:after {
    background: #ffffff;
    }

    .tgl-inline {
    display: inline-block !important;
    vertical-align: top;
    }

    .tgl-inline.tgl {
    font-size: 16px;
    }

    .tgl-inline.tgl span {
    min-width: 50px;
    }

    .tgl-inline.tgl span:before {
    line-height: 1.4em;
    padding-left: 0.4em;
    padding-right: 0.4em;
    }

    .tgl-inline-label {
    display: inline-block !important;
    vertical-align: top;
    line-height: 26px;
    }
    </style>
    @yield ('style')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="divLoading">
</div>
<div class="wrapper">
    {{--<audio id="audiotag1" src="{{asset('notif/notif.MP3')}}" preload="auto"></audio>--}}
    {{--document.getElementById('audiotag1').play();--}}
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" id="re" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-exchange"></i>
                            <span class="label label-success" id="req">{{count($req)}}</span>
                        </a>
                        <ul class="dropdown-menu" style="width: auto">
                            <li class="header">Anda mempunyai <strong id="req2">{{count($req)}}</strong> permintaan </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu" id="listreq">
                                    @foreach($req as $row)
                                        <?php $min = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at); ?>
                                        @if ($min->copy()->addDays(2)->gte(\Illuminate\Support\Carbon::now()))
                                            <?php $mins = $min->copy()->diffForHumans(); ?>
                                        @elseif ($min->copy()->addDay()->gte(\Illuminate\Support\Carbon::now()))
                                            <?php $mins = 'Kemarin'; ?>
                                        @else
                                            <?php $mins = $min->copy()->formatLocalized('%d %B %Y'); ?>
                                        @endif
                                    <li id="requ{{$row->id}}"><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{asset($row->user->ava)}}" class="img-circle"
                                                     alt="User Image">
                                            </div>
                                            <h4>
                                                {{$row->user->name}}
                                                <small><i class="fa fa-clock-o"></i> {{$mins}}</small>
                                            </h4>
                                            <p>{{$row->user->posisitions->name}} di {{$row->user->jobs->name}} &rarr; {{$row->posisition->name}} di {{$row->job->name}}</p>
                                            <button class="btn btn-primary" data-id="{{$row->id}}" data-li="requ{{$row->id}}" onclick="terimaData(this)">Terima</button>
                                            <button class="btn btn-default" data-id="{{$row->id}}" data-li="requ{{$row->id}}" onclick="tolakData(this)">Abaikan</button>
                                        </a>
                                    </li>
                                    @endforeach
                                    <!-- end message -->

                                </ul>
                            </li>
                            <li class="footer"><a href="#">Lihat Semua</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    {{--<li class="dropdown notifications-menu">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-bell-o"></i>--}}
                            {{--<span class="label label-warning">10</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li class="header">You have 10 notifications</li>--}}
                            {{--<li>--}}
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{--<ul class="menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-warning text-yellow"></i> Very long description here that--}}
                                            {{--may not fit into the--}}
                                            {{--page and may cause design problems--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-red"></i> 5 new members joined--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-shopping-cart text-green"></i> 25 sales made--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-user text-red"></i> You changed your username--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="footer"><a href="#">View all</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown messages-menu">
                        <a href="{{route('dashboard')}}">
                            <i class="fa fa-eye"></i>
                            <span class="label label-info">WEB</span>
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle"
                           data-toggle="dropdown">
                            @if(Auth::user()->ava == null)
                                <img src="{{asset('storage/admin/dummy-profile.jpg')}}"
                                     class="user-image"
                                     alt="User Image">
                            @else
                                <img src="{{asset(Auth::user()->ava)}}"
                                     class="user-image"
                                     alt="User Image">
                            @endif
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(Auth::user()->ava == null)
                                    <img src="{{asset('storage/admin/dummy-profile.jpg')}}"
                                         class="img-circle"
                                         alt="User Image">
                                @else
                                    <img src="{{asset(Auth::user()->ava)}}"
                                         class="img-circle"
                                         alt="User Image">
                                @endif
                                <?php $dt = \App\trDataPosisition::findOrFail(Auth::user()->posisition_id) ?>
                                <?php $dt2 = \App\trDataJobDesc::findOrFail(Auth::user()->job_id) ?>
                                <p>{{Auth::user()->name}}
                                    <small>{{$dt->name}} di {{$dt2->name}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <a href="#">{{Auth::user()->email}}</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('user.update')}}"
                                       class="btn btn-default btn-flat">Edit Profil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user()->ava == null)
                        <img src="{{asset('storage/admin/dummy-profile.jpg')}}" class="user-image"
                             alt="User Image">
                    @else
                        <img src="{{asset(Auth::user()->ava)}}" class="img-circle user-image" alt="User Image">
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <br>
            <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
        {{--</button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            @yield ('sidenav')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <!-- /.content-wrapper -->
    @yield ('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            {{--<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>--}}
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-user bg-yellow"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                <p>New phone +1(800)555-1234</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                <p>nora@example.com</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="menu-icon fa fa-file-code-o bg-green"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                <p>Execution time 5 seconds</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Update Resume
                                <span class="label label-success pull-right">95%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Laravel Integration
                                <span class="label label-warning pull-right">50%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <h4 class="control-sidebar-subheading">
                                Back End Framework
                                <span class="label label-primary pull-right">68%</span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">

                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Other sets of options are available
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div>
                    <!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
//    $(function () {
//        $("#example1").DataTable();
//        $("#example2").DataTable();
//        $("#example3").DataTable();
//        $("#example4").DataTable();
//        $("#example5").DataTable();
//        /*$('#example2').DataTable({
//         "paging": true,
//         "lengthChange": false,
//         "searching": false,
//         "ordering": true,
//         "info": true,
//         "autoWidth": false
//         });*/
//    });
</script>
<script>
    $(document).ready(function () {

        setInterval(function () {
            getRealData1()
        }, 9000);//request every x seconds

        function getRealData1() {
            var requ;
            $.ajax({
                type: 'get',
                url: '{{route('admin.datauniv')}}',
                success: function (data) {
//                    console.log(data);
                    requ = '';
                    var audio = '';
                    if (data.status == 1) {

                        for (var i = 0; i < data.req.length; i++) {
                            requ += '<li style="background-color:#EAF2F8 " id="requ'+data.req[i].id+'"><a href="#">\n' +
                                '                                            <div class="pull-left">\n' +
                                '                                                <img src="' + data.req[i].ava + '" class="img-circle" alt="User Image">\n' +
                                '                                            </div>\n' +
                                '                                            <h4>\n' +
                                '                                                ' + data.req[i].name + '\n' +
                                '                                                <small><i class="fa fa-clock-o"></i> ' + data.req[i].min + '</small>\n' +
                                '                                            </h4>\n' +
                                '                                            <p>' + data.req[i].dari + ' &rarr; ' + data.req[i].ke + '</p>\n' +
                                ' <button class="btn btn-primary" data-id="'+data.req[i].id+'" data-li="requ'+data.req[i].id+'" onclick="terimaData(this)">Terima</button>\n'+
                                ' <button class="btn btn-default" data-id="'+data.req[i].id+'" data-li="requ'+data.req[i].id+'" onclick="tolakData(this)">Abaikan</button> \n' +
                                '                                        </a></li>'
                        }
                        var entireq = '';
                        entireq = '';var entireq2 = '';
                        entireq2 = '';
                        $add = data.req.length ;
                        entireq = parseInt($("#req").text());
                        entireq2 = parseInt($("#req2").text());
                        $('#listreq').prepend(requ);
                        if ($('#req').text() == '') {
                            $('#req').text($add);
                        }
                        else {
$hasil=0;
                            $('#req').text($hasil = entireq+$add);
                        }
                        $hasil=0;
                        $('#req2').text($hasil = entireq2+$add);
                        audio = new Audio('{{asset('notif/notif.MP3')}}');
                        audio.play();
                    }

                },
                error: function () {
                    swal({
                        title: 'Oops...',
                        text: 'something wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                    location.reload();
                }
            });

        }
    });

    $('#re').click(function () {

        $('#req').text('');
    });

    function terimaData(qwe) {

        console.log($(qwe).data('id'));
        $li=$(qwe).data('li');
//        $('#listreq #'+$li).html();
$entireq2=parseInt($('#req2').text());
        $.ajax({
            type: 'get',
            url: '{{route('admin.accept')}}',
            data: {'id':$(qwe).data('id')},
            success: function (data) {
                console.log(data);
                $('#'+$li).empty();
                $hasil=0;
                $('#req2').text($hasil = $entireq2-1);
            },
            error: function () {
                swal({
                    title: 'Oops...',
                    text: 'something wrong!',
                    type: 'error',
                    timer: '1500'
                })
            }
        });

    }
    function tolakData(qwe) {

        console.log($(qwe).data('id'));
        $li=$(qwe).data('li');
//        $('#listreq #'+$li).html();
$entireq2=parseInt($('#req2').text());
        $.ajax({
            type: 'get',
            url: '{{route('admin.reject')}}',
            data: {'id':$(qwe).data('id')},
            success: function (data) {
                console.log(data);
                $('#'+$li).empty();
                $hasil=0;
                $('#req2').text($hasil = $entireq2-1);
            },
            error: function () {
                swal({
                    title: 'Oops...',
                    text: 'something wrong!',
                    type: 'error',
                    timer: '1500'
                })
            }
        });

    }
</script>
@yield('script')
</body>
</html>
