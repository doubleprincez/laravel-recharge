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
                <img src="images/img.jpg" alt="">John Doe
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>


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
      <div class="row tile_count">
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


      </div>


      <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>All Users
                                    <small> Account</small>
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
                                        <th>FullName</th>
                                        <th>Mobile</th>
                                        <th>Sponsor Name</th>
                                        <th>Sponsor Mobile</th>
                                        <th>Status</th>

                                        <th>Registration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->name}}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#edituser-{{$item->id}}">Edit
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm btn-round"  data-toggle="modal" data-target="#deluser-{{$item->id}}">Delete
                                            </button>

                                            <button type="button" class="btn btn-info btn-sm btn-round"
                                                    data-toggle="modal" data-target="#bonuses-{{$item->id}}">Bonuses
                                            </button>


                                              @if($item->special==0)
                                              <button  type="submit " class="btn btn-info btn-sm btn-round btn-sm"
                                                      > <a href="{{route('user.special', ['id'=>$item->id])}}">Make Special</a>
                                              </button>

                                              @else
                                              <button  type="submit " class="btn btn-info btn-sm btn-round btn-sm"
                                                      > <a href="{{route('user.specialunset', ['id'=>$item->id])}}">Remove Special</a>
                                              </button>

                                              @endif

                                        </td>
                                    </tr>
<!-- edit user details modal -->

<div class="modal fade" id="edituser-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">User's Details {{$item->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-label-left input_mask" action="{{route('user.update', ['id'=>$item->id])}}" method="get">
@csrf
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2"
                               placeholder="Fullname" name="name" value="{{$item->name}}">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4"
                               placeholder="Email" name="email" value="{{$item->email}}">
                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control" id="inputSuccess5" name="phone" placeholder="Phone" value="{{$item->mobile}}">
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="password" class="form-control" id="inputSuccess5" name="password" placeholder="Update Password">
                        <span class="fa fa-cog form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>





<!-- end edit used modal -->


<!-- delete user modal -->

<div class="modal fade" id="deluser-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal form-label-left input_mask">


                    <h3 class="text-center text-danger">Sure to delete {{$item->name}} from user's list?</h3>
                    <button type="submit" class="btn btn-info float-right">Cancel</button>

                    <form class="" action="{{route('user.delete', ['id'=>$item->id])}}" method="GET">
                      <button type="submit" class="btn btn-danger float-right">Delete</button>

                    </form>

                </form>
            </div>


        </div>
    </div>
</div>

<!-- delete user modal  -->





                                    <!-- user Bonuses -->
                                    <div class="modal fade" id="bonuses-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="exampleModalLabel">User's Bonus</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="row tile_count">
                                                        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                                                            <span class="count_top"><i class="fa fa-user"></i> Card Bonus</span>
                                                            <div class="count">{{$item->card_bonus}}</div>
                                                            <div class="col-md-6">
                                                              <form  action="{{route('card.reset', ['id'=>$item->id])}}" method="GET">
                                                                @csrf
                                                                  <button type="submit" id="creset" class="btn btn-sm btn-danger">Reset</button>
                                                              </form>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-sm btn-primary" id="cedit" onclick="Card()">Edit
                                                                </button>
                                                            </div>


                                                            <form action="{{route('card.update', ['id'=>$item->id])}}" method="GET">
                                                                @csrf
                                                              <input type="text" class="form-control" name="cbonus" id="cbonus" placeholder="New Card Bonus">
                                                              <br>

                                                              <button type="submit" name="cupdate" class="btn btn-sm btn-primary btn-block" id="cupdate">
                                                                  Update
                                                              </button>
                                                            </form>



                                                        </div>
                                                        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                                                            <span class="count_top"><i class="fa fa-clock-o"></i> Monthly Bonus </span>
                                                            <div class="count">{{$item->monthly_bonus}}</div>
                                                            <div class="col-md-6">
                                                              <form action="{{route('monthly.reset', ['id'=>$item->id])}}" method="GET">
                                                                <button type="submit" name="mreset" id="mreset" class="btn btn-sm btn-danger">Reset</button>
                                                              </form>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-sm btn-primary" id="medit"
                                                                        onclick=" Monthly()">Edit
                                                                </button>
                                                            </div>
                                                                <form action="{{route('monthly.update', ['id'=>$item->id])}}" method="GET">
                                                                  @csrf
                                                            <input type="text" class="form-control" name="mbonus" id="mbonus"
                                                                   placeholder="New Monthly Bonus">
                                                            <br>
                                                            <button type="submit" name="cupdate" class="btn btn-sm btn-primary btn-block" id="mupdate">
                                                                Update
                                                            </button>
                                                          </form>


                                                        </div>


                                                        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                                                            <span class="count_top"><i class="fa fa-user"></i> Travelling Bonus</span>
                                                            <div class="count green">{{$item->travelling_bonus}}</div>
                                                            <div class="col-md-6">
                                                              <form  action="{{route('travel.reset', ['id'=>$item->id])}}" method="GET">
                                                                  <button type="submit" name="treset" id="treset" class="btn btn-sm btn-danger">Reset</button>
                                                              </form>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-sm btn-primary" id="tedit"
                                                                        onclick="Travel()">Edit
                                                                </button>
                                                            </div>
                                                              <form  action="{{route('travel.update', ['id'=>$item->id])}}" method="GET">
                                                                @csrf
                                                            <input type="text" class="form-control" name="tbonus" id="tbonus"
                                                                   placeholder="New Travelling Bonus">
                                                            <br>
                                                            <button type="submit" name="tupdate" class="btn btn-sm btn-primary btn-block" id="tupdate">
                                                                Update
                                                            </button>
                                                          </form>
                                                        </div>
                                                        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                                                            <span class="count_top"><i class="fa fa-user"></i>Festival Bonus</span>
                                                            <div class="count">{{$item->festival_bonus}}</div>
                                                            <div class="col-md-6">
                                                              <form  action="{{route('festival.reset', ['id'=>$item->id])}}" method="get">
                                                                @csrf
                                                                  <button type="submit" name="freset" id="freset" class="btn btn-sm btn-danger">Reset</button>
                                                              </form>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <button type="button" class="btn btn-sm btn-primary" id="fedit"
                                                                        onclick="Festival()">Edit
                                                                </button>
                                                            </div>
                                                            <form  action="{{route('festival.update', ['id'=>$item->id])}}" method="get">
                                                              @csrf
                                                            <input type="text" class="form-control" name="fbonus" id="fbonus"
                                                                   placeholder="New Festival Bonus">
                                                            <br>
                                                            <button type="submit" name="fupdate" class="btn btn-sm btn-primary btn-block" id="fupdate">
                                                                Update
                                                            </button>
                                                              </form>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info float-right" data-dismiss="modal">Cancel</button>

                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    </tbody>
                                </table>


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
