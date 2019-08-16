@extends('layouts.admin.script')
@section('content')

<body class="nav-md">
<div class="container body">
  <div class="main_container">

  <!-- side navigation -->
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
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{asset(auth()->user()->avatar?'/storage/'.auth()->user()->avatar:'img/default-avatar.png')}}" alt="">{{asset(auth()->user()->name?auth()->user()->name:'No Name')}}
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">

                  <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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

      <!-- /top tiles -->



      <div class="row">

<!-- do not touch -->
        <div class="col-md-4 col-sm-4 col-xs-12" hidden>
          <div class="x_panel tile fixed_height_320">
            <div class="x_content" hidden>
              <h4>App Usage across versions</h4>
              <div class="widget_summary">
                <div class="w_left w_25">
                  <span>0.1.5.2</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                      <span class="sr-only">60% Complete</span>
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span>123k</span>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- end do not touch -->


      </div>


      <div class="row">


        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#form">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                          </div>
                          <div class="count">01</div>

                          <h3>Airtime Recharge</h3>
                          <p>admin airtime service</p>
                        </div>
                      </div>


        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#buyData">
                                      <div class="tile-stats">
                                        <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                        </div>
                                        <div class="count">02</div>

                                        <h3>Mobile Data Purchase</h3>
                                        <p>Admin data service</p>
                                      </div>
                                    </div>

        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#cabletv">
                <div class="tile-stats">
                    <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                                      </div>
                                                      <div class="count">03</div>

                                                      <h3>Cable tv Subscription</h3>
                                                      <p>Admin cable tv service</p>
                                                    </div>
                                                  </div>


            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#electricity">
                                                                  <div class="tile-stats">
                                                                    <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                                                    </div>
                                                                    <div class="count">04</div>

                                                                    <h3>Electricity</h3>
                                                                    <p>Admin Electricity service</p>
                                                                  </div>
                                                                </div>

                                                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#Topup">
                                                                                <div class="tile-stats">
                                                                                  <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                                                                  </div>
                                                                                  <div class="count">o5</div>

                                                                                  <h3>Fund User Wallet</h3>
                                                                                  <p>admin wallet sevice</p>
                                                                                </div>
                                                                              </div>











          @include('includes.serviceadmin')
      </div>

                        </div>
                    </div>

                </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->

  </div>
</div>
</body>
@endsection
