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
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{ $info->count() }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>


            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Administrator Counts</span>
              <div class="count">{{ __('10') }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Male User</span>
              <div class="count green">{{ $info->where('gender','=','M')->count() }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Female User</span>
              <div class="count">{{ $info->where('gender','=','F')->count() }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>Activated Account</span>
              <div class="count">{{ $info->where('verified','=',1)->count() }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Unactivacted Account</span>
              <div class="count">{{ $info->where('verified','=',0)->count() }}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>


          </div>
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

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Special Bonus<small> Account</small></h2>
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
                      <th>FullName</th>
                      <th>Mobile</th>

                        <th>Bonus %</th>

                          <th>Bonus Earnings</th>
                      <th>Registration Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>


                  @foreach( $special  as $special)
                  <form action="{{route('specialbonus.update', ['id'=>$special->id])}}" method="get">
                    @csrf
                    <tbody>
                      <tr>
                        <td>
                          {{$special->name}}
                        </td>
                        <td>
                          {{$special->mobile}}
                        </td>
                        <td>
                        <div class="form-group has-feedback col-md-4">
                        <input type="text" class="form-control" placeholder="percentage" name="percent" value="{{$special->specialpcent}}" />
                        <i class="fa fa-percent form-control-feedback"></i>
                        </div>
                      </td>
                      <td>
                        {{$special->special_bonus}}
                      </td>

                        <td>
                          {{$special->created_at}}
                        </td>
                        <td>
                             <button type="submit" class="btn btn-info btn-sm btn-round" >Update</button>
                        </td>
                      </tr>
                    </tbody>
                  </form>

                  @endforeach
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
