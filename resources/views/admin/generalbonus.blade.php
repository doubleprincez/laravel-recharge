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
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{asset(auth()->user()->avatar?'/storage/'.auth()->user()->avatar:'img/default-avatar.png')}}" alt="">{{asset(auth()->user()->name?auth()->user()->name:'No Name')}}
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:;"> Profile</a></li>

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
        <div class="">

          <div class="clearfix"></div>

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

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Bonus<small>Settings</small></h2>
                  <ul class="nav navbar-right panel_toolbox">

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <form class="form-horizontal form-label-left"  novalidate action="{{route('userbonus.put', ['id'=>$bonus['id']])}}" method="get">
@csrf

                      <span class="section">Users Bonus in %age</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cbonus">Card Bonus <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" value="{{$bonus['card_bonus']}}"  name="cbonus" placeholder="10.00%" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fbonus">Festival Bonus<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="fbonus" required="required" value="{{$bonus['festival_bonus']}}"  class="form-control col-md-7 col-xs-12" placeholder="34.6%">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mbons">Monthly Bonus <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" name="mbonus" required="required" value="{{$bonus['monthly_bonus']}}" placeholder="56.9%" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tbonus">Travelling Bonus <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" name="tbonus" placeholder="0.89%" value="{{$bonus['travelling_bonus']}}" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>





                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="reset" class="btn btn-primary">Cancel</button>
                          <button  type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>



                </div>
              </div>
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
