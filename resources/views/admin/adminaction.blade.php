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
                <h2>All Users<small> Account</small></h2>
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
                        <th>E-mail</th>

                      <th>Actions</th>
                    </tr>
                  </thead>


                  <tbody>
                  @foreach($info as $info)

                <tr>
                  <td>{{$info['fullname']}}</td>
                  <td>{{$info['telephone']}}</td>
                  <td>{{$info['email']}}</td>


                  <td>
                 <button type="button" class="btn btn-primary btn-sm btn-round" data-toggle="modal" data-target="#editadmin-{{$info['id']}}">Edit</button>

                    <button type="button" class="btn btn-danger btn-sm btn-round"  data-toggle="modal" data-target="#deladmin-{{$info['id']}}">Delete</button>

                     <button type="button" class="btn btn-info btn-sm btn-round" data-toggle="modal" data-target="#editadminpassword-{{$info['id']}}">Change Password</button>


                  </td>
                </tr>

                <div class="modal fade" id="editadmin-{{$info['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Admin Details {{$info['id']}} {{$info['fullname']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form class="form-horizontal form-label-left input_mask" action="{{route('admin.detail', ['id'=>$info->id])}}" method="get">
@csrf
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2"
                                               placeholder="Fullname" value="{{$info['fullname']}}" name="fullname">
                                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" id="inputSuccess4"
                                               placeholder="Email" value="{{$info['email']}}" name="email">
                                        <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <input type="text" class="form-control" id="inputSuccess5" placeholder="Phone" name="phone" value="{{$info['telephone']}}">
                                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    <div class="modal-footer border-top-0 d-flex justify-content-center">

                                          <button type="submit" class="btn btn-success">Update</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adin password Update -->
                <div class="modal fade" id="editadminpassword-{{$info['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title" id="exampleModalLabel">Change Password -{{$info['id']}} -{{$info['fullname']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form class="form-horizontal form-label-left input_mask" action="{{route('admin.password', ['id'=>$info->id])}}" method="post">

@csrf
                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                        <input type="password" class="form-control" id="inputSuccess5" name="passwordadmin"
                                               placeholder="Update Password">
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



                <!-- Admin delete Modal -->


                <!-- delete User -->
                <div class="modal fade" id="deladmin-{{$info['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form class="form-horizontal form-label-left input_mask">
                                    <h3 class="text-center text-danger">Sure to delete ?</h3>
                                    <button type="submit" class="btn btn-info float-right">Cancel</button>
                                    <button type="submit" class="btn btn-danger float-right">Delete</button>

                                </form>
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
