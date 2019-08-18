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
                                <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="{{ asset(auth()->user()->avatar ? auth()->user()->avatar:'img/default-avatar.png') }}"
                                         alt="No Thumbnail">
                                    {{  auth()->user()->name?auth()->user()->name:'No Name'}}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li>
                                        <a href="{{ route('profile') }}">Profile Page</a>
                                    </li>
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
                        <span class="count_top"><i class="fa fa-user"></i> Abuja</span>
                        <div class="count">{{ $abuja_day->count() }}<span>Daily</span></div>
                        <div class="count">{{ $abuja_month->count() }}<span>Monthly</span></div>
                        <div class="count">{{ $abuja_year->count() }}<span>Yearly</span></div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Eko</span>
                        <div class="count green">{{ $eko_day->count() }}<span>Daily</span></div>
                        <div class="count green">{{ $eko_month->count() }}<span>Monthly</span></div>
                        <div class="count green">{{ $eko_year->count() }}<span>Yearly</span></div>

                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Enugu</span>
                        <div class="count">{{ $enugu_day->count() }}<span>Daily</span></div>
                        <div class="count">{{ $enugu_month->count() }}<span>Monthly</span></div>
                        <div class="count">{{ $enugu_year->count() }}<span>Yearly</span></div>
                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-clock-o"></i>Ibadan</span>
                        <div class="count">{{ $ibadan_day->count() }}<span>Daily</span></div>
                        <div class="count">{{ $ibadan_month->count() }}<span>Monthly</span></div>
                        <div class="count">{{ $ibadan_year->count() }}<span>Yearly</span></div>
                    </div>

                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Ikeja</span>
                        <div class="count">{{ $ikeja_day->count() }}<span>Daily</span></div>
                        <div class="count">{{ $ikeja_month->count() }}<span>Monthly</span></div>
                        <div class="count">{{ $ikeja_year->count() }}<span>Yearly</span></div>

                    </div>


                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i> Port-Harcourt</span>
                        <div class="count">{{ $port_day->count() }}<span>Daily</span></div>
                        <div class="count">{{ $port_month->count() }}<span>Monthly</span></div>
                        <div class="count">{{ $port_year->count() }}<span>Year</span></div>
                    </div>


                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Most Purchased (currently)</span>
                        <div class="count">{{ $most_purchase_day?$most_purchase_day->count():'None'  }}<span>Daily</span></div>
                        <div class="count">{{ $most_purchase_month?$most_purchase_month->count():'None' }}<span>Monthly</span></div>
                        <div class="count">{{ $most_purchase_year?$most_purchase_year->count():'None' }}<span>Yearly</span></div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                        <span class="count_top"><i class="fa fa-user"></i>Most purchased by</span>
                        <div class="count">{{ $most_purchase_by_day?$most_purchase_by_day->count():'No One' }}<span>Daily</span></div>
                        <div class="count">{{ $most_purchase_by_month?$most_purchase_by_month->count():'No One' }}<span>Monthly</span></div>
                        <div class="count">{{ $most_purchase_by_year?$most_purchase_by_year->count():"No One" }}<span>Yearly</span></div>
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
                                        <th>Transaction id</th>
                                        <th>Account</th>
                                        <th>Type</th>
                                        <th>General Name</th>
                                        <th>Amount</th>

                                    </tr>
                                    </thead>


                                    <tbody>
                                    @if(isset($electricity))
                                        @foreach($electricity as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->transaction_id }}</td>
                                                <td>{{ $item->account }}</td>
                                                <td>
                                                    {{ $item->type }}

                                                </td>

                                                <td>{{ $item->amount }}</td>

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
