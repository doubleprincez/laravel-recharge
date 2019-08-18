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
                    <img src="{{ asset(auth()->user()->avatar ? auth()->user()->avatar:'img/default-avatar.png') }}"  alt="No Thumbnail">
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
              <span class="count_top"><i class="fa fa-clock-o"></i>9mobile</span>
              <div class="count">{{ $airtel_day->count() }}<span>Daily</span></div>
              <div class="count">{{ $airtel_month->count() }}<span>Monthly</span></div>
              <div class="count">{{ $airtel_year->count() }}<span>Yearly</span></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Glo</span>
              <div class="count green">{{ $glo_day->count() }}<span>Daily</span></div>
              <div class="count green">{{ $glo_month->count() }}<span>Monthly</span></div>
              <div class="count green">{{ $glo_year->count() }}<span>Years</span></div>

            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Mtn</span>
              <div class="count">{{ $mtn_day->count() }}<span>Daily</span></div>
              <div class="count">{{ $mtn_month->count() }}<span>Monthly</span></div>
              <div class="count">{{ $mtn_year->count() }}<span>Years</span></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Most Purchased (currently)</span>
              <div class="count">{{  $most_purchased_day? $most_purchased_day:"None"}}<span>Daily</span></div>
              <div class="count">{{  $most_purchased_day? $most_purchased_day:"None"}}<span>Weekly</span></div>
              <div class="count">{{  $most_purchased_day? $most_purchased_day  :"None"}}<span>Yearly</span></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Most purchased by</span>
              <div class="count">{{ $most_purchase_by_day?$most_purchase_by_day->name:"No one" }}<span>Daily</span></div>
              <div class="count">{{ $most_purchase_by_month?$most_purchase_by_month->name:"No one" }}<span>Monthly</span></div>
              <div class="count">{{ $most_purchase_by_year?$most_purchase_by_year->name:"No one" }}<span>Yearly</span></div>
            </div>
          </div>
          <!-- /top tiles -->






      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Airtime<small> purchase History</small></h2>
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
                      <th>s/n</th>
                      <th>Type</th>
                        <th>Network id</th>
                        <th>General Name</th>
                        <th>Package</th>
                      <th>Amount</th>

                    </tr>
                  </thead>


                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>2</td>
                      <td>3</td>
                      <td>GLO</td>
                      <td>Glo 1gb</td>
                      <td>600</td>

                    </tr>



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
