<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ route('admin.index') }}" class="site_title">{{ config('app.name') }}<span></span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{asset(auth()->user()->avatar?auth()->user()->avatar:'img/default-avatar.png')}}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>Admin</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="{{route('admin.index')}}"><i class="fa fa-home"></i>Dashboard</a> </li>
          <li><a  ><i class="fa fa-edit"></i> Administrators <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('admin.add')}}">Add New</a></li>
              <li><a href="{{route('admins')}}">Accounts</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-desktop"></i> Settings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('admin.webset')}}">Web Settings</a></li>
              <li><a href="{{route('admin.usbonus')}}">Bonus Settings</a></li>
              <li><a href="{{route('admin.spcbonus')}}">Special Bonus Settings</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-table"></i>Reports<span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{route('admin.airtime')}}">Airtime Sales Reports</a></li>
                <li><a href="{{route('admin.cabletv')}}">Cable TV Purchase Report</a></li>
              <li><a href="{{route('admin.datapurchase')}}">Data Purchase Report</a></li>
              <li><a href="{{route('admin.electric')}}">Electricity Purchase Report</a></li>
            </ul>
          </li>

          <li><a href="{{route('admin.services')}}"><i class="fa fa-table"></i>Services</span></a></li>


        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      {{--<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">--}}
       {{----}}
      {{--</a>--}}
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
