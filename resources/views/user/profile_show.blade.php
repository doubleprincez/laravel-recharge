@extends('../layouts.script')
<body>
@section('content')

    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <!--
              Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
          -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="{{ asset('storage/'.auth()->user()->avatar) }}">
                    </div>
                </a>
                <a href="{{ url('/home') }}" class="simple-text logo-normal">
                    {{ auth()->user()->name }}
                    <div class="logo-image-big">
                        Balance: &#8358;{{ number_format(auth()->user()->wallet->wallet_balance) }}
                    </div>
                </a>
            </div>
            <div class="sidebar-wrapper">
                @include('../layouts.sidenav')
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <!-- <a class="navbar-brand" href="#pablo">Paper Dashboard 2</a> -->
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        @if(auth()->user()->can_withdraw ===1)
                            <ul class="navbar-nav pull-left">
                                <li class="{{ active('cashout') }}"><a href="{{ route('cashout.show') }}">Cashout</a></li>
                            </ul>
                        @endif
                        <ul class="navbar-nav pull-right">

                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href=""
                                   id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="nc-icon nc-user-run"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item {{ active(['profile','profile/*']) }}"
                                       href="{{route('profile', ['id'=>auth()->user()->id])}}">My Profile</a>
                                    <a class="dropdown-item {{ active('downlines') }}" href="{{ url('downlines') }}">Downlines</a>
                                    <a class="dropdown-item {{ active('transactions') }}"
                                       href="{{ url('transactions') }}">Transactions</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- <div class="panel-header panel-header-sm">


        </div> -->
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}'s Wallpaper">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        <img class="avatar border-gray" src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{auth()->user()->name}}'s Avatar">
                                        <h5 class="title">{{ auth()->user()->name }}</h5>
                                    </a>
                                    <!-- <p class="description">
                                      @chetfaker
                                    </p> -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="button-container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12 ml-auto">
                                            <h5>{{auth()->user()->wallet_id }}
                                                <br>
                                                <small>Wallet id</small>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card card-user">
                            <div class="card-header">
                                <h5 class="card-title">Profile</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <div class="form-group">
                                                <label>Mobile</label>
                                                <div>{{auth()->user()->mobile}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-1">
                                            <div class="form-group">
                                                <label>Fullname</label>
                                                <div>{{auth()->user()->name}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <div>{{auth()->user()->email}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div>{{auth()->user()->gender?auth()->user()->gender:"Not Set"}} </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="update ml-auto mr-auto">
                                            <a href="{{route('profile.edit', ['83jffd03u'=>encrypt(auth()->user()->id)])}}"
                                               class="btn btn-primary btn-round">Edit Profile</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer footer-black  footer-white ">
                <div class="container-fluid">
                    <div class="row">

                        <div class="credits ml-auto">
            <span class="copyright"> ©
              <script>
                document.write(new Date().getFullYear())
              </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
            </span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
