@extends('layouts.admin.script')
@section('content')

    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
        @include('layouts.admin.sidenav')
        <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="images/img.jpg" alt="">Administrator
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <!-- <li>
                                      <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                      </a>
                                    </li> -->
                                    <!-- <li><a href="javascript:;">Help</a></li> -->
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>


                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <div class="row tile_count">

                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i>9mobile</span>
                        <div class="count">{{ $airtel->count() }}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Glo</span>
                        <div class="count green">{{ $glo->count() }}</div>

                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Mtn</span>
                        <div class="count">{{ $mtn->count() }}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Most Purchased (currently)</span>
                        <div class="count">{{  $most_purchased}}</div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Most purchased by</span>
                        <div class="count">{{ $most_purchase_by->name }}</div>
                    </div>
                </div>
                <!-- /top tiles -->

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Airtime
                                    <small> purchase History</small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <!--  -->
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>User Name</th>
                                        <th>Type</th>
                                        <th>Network id</th>
                                        <th>General Name</th>
                                        <th>Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($recharges))
                                        @foreach($recharges as $recharge)
                                            <tr>

                                                <td>{{ $recharge->id }}</td>
                                                <td>{{ $recharge->user->name }}</td>
                                                <td>{{ $recharge->type }}</td>
                                                <td>{{ $recharge->network_id }}</td>
                                                <td><?php
                                                        $item =(int) $recharge->network_id;
                                                switch($item){
                                                        case $item === 1:
                                                            echo "Airtel";
                                                            break;

                                                        case $item ===2:
                                                           echo "MTN";
                                                            break;
                                                        case $item ===3:

                                                            echo"Glo";
                                                            break;
                                                        case $item ===4:
                                                            echo "9Mobile";
                                                            break;
                                                    } ?></td>
                                                <td>&#8358;{{ number_format($recharge->amount,2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                                @include('admin.modals')
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer class="navbar navbar-fixed-bottom">
                    <div class="pull-right">
                        Developed by DevAdewale <a href="https://colorlib.com">Gtech</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>


    </body>
@endsection
