@extends('layouts.script')
@section('content')
    @if(!empty($errors->first()))

        <div class="alert alert-danger text-center centeredText">
            <span class="title-up">{{ $errors->first() }}</span>
        </div>

    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger text-center centeredText">
            {{ session()->get('error') }}
        </div>

    @endif
    @if(session()->has('success'))
        <div class="alert alert-success text-center centeredText">
            {{ session()->get('success') }}
        </div>

    @endif
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">

            <div class="logo">
                <a href="{{ url('/home') }}" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="{{asset('storage/'.auth()->user()->avatar) }}" height="50" width="40">
                    </div>
                </a>
                <a href="#" class="simple-text logo-normal">
                    {{ auth()->user()->name }}
                    <div class="logo-image-big">
                        Balance: &#8358;{{ number_format(auth()->user()->wallet->wallet_balance, 2) }}
                    </div>
                </a>
            </div>
            <div class="sidebar-wrapper">
                @include('layouts.sidenav')
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
                        <!-- T Fix dropdown for mobile view -->
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
                                <li class="nav-item {{ active('cashout') }}"><a href="{{ route('cashout.show') }}">Cashout</a>
                                </li>
                            </ul>
                        @endif
                        <ul class="navbar-nav pull-right">
                            <li class="nav-item"> <?php if(auth()->user()->isAdmin == 1){?> <a href="{{url('cpanel/admin-page')}}">Admin</a> <?php } else echo ' Normal User ';?></li>

                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href=""
                                   id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="nc-icon nc-user-run"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block"></span>
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
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <!-- <div class="panel-header panel-header-lg">

        <canvas id="bigDashboardChart"></canvas>
        </div> -->
            <div class="content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-globe text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">WALLET</p>
                                            <p class="card-title" style="font-size: 18px !important;">
                                                &#8358;{{ number_format(auth()->user()->wallet->wallet_balance, 2) }}
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-refresh"></i>Walet id: {{ auth()->user()->wallet_id}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-vector text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Festival Bonus</p>
                                            <p class="card-title">
                                                &#8358;{{ number_format((float)auth()->user()->my_wallet()->festival_bonus,2) }}
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i> In the last hour
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center icon-warning">
                                            <i class="nc-icon nc-favourite-28 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category">Monthly Bonus</p>
                                            <p class="card-title">
                                                &#8358;{{ number_format((float)auth()->user()->my_wallet()->monthly_bonus,2) }}
                                            <p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-refresh"></i>{{ auth()->user()->my_wallet()->updated_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->my_wallet()->special === 1)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="icon-big text-center icon-simple">
                                                <i class="nc-icon nc-money-coins text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="numbers">
                                                <p class="card-category">Special Bonus</p>
                                                <p class="card-title">
                                                    &#8358;{{ number_format((float)auth()->user()->my_wallet()->special_bonus,2) }}
                                                <p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-calendar-o"></i> Last day
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
                <button type="button" id="defaultServices" class="btn btn-primary float-right" onclick="setDefault()" style="display: none;">Standard services</button>
                <button type="button" id="specialServices" class="btn btn-primary float-right" onclick="setSpecial()">Extra pay services</button>
                <hr>
                <h3 id="dpMsg">USER CONTROLS - WITHOUT BONUS</h3>
                <div class="row">
                    <div id="rechargeBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#form">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-mobile text-success"></i>

                                    </div>
                                    <div class="numbers" data-toggle="modal" data-target="#form">
                                        <p class="card-category" style="text-align:center !important; font-size: 16px; "
                                           data-toggle="modal" data-target="#form"> Purchase Airtime </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div id="dataBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#buyData">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-planet text-success"></i>

                                    </div>

                                    <div class="numbers" data-toggle="modal" data-target="#buyData">
                                        <p class="card-category"
                                           style="text-align:center !important; font-size: 16px; "> Purchase Mobile
                                            Data </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="cableBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#cabletv">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-tv-2 text-success"></i>

                                    </div>

                                    <div class="numbers">
                                        <p class="card-category"
                                           style="text-align:center !important; font-size: 16px; "> Pay Cable TV </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="electricityBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#electricity">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-globe text-success"></i>

                                    </div>

                                    <div class="numbers">
                                        <p class="card-category"  style="text-align:center !important; font-size: 16px; "> Electricity </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--<div id="pinBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#buyPin">--}}
                        {{--<div class="card card-stats">--}}
                            {{--<div class="card-body ">--}}
                                {{--<div style="margin:10px;">--}}

                                    {{--<div class="icon-big text-center icon-warning">--}}
                                        {{--<i class="nc-icon nc-credit-card text-success"></i>--}}
                                    {{--</div>--}}
                                    {{--<div class="numbers">--}}
                                        {{--<p class="card-category"--}}
                                           {{--style="text-align:center !important; font-size: 16px; ">Buy Scratch card</p>--}}

                                    {{--</div>--}}
                                {{--</div>--}}


                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    <div id="walletBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#wallet">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-send text-success"></i>

                                    </div>

                                    <div class="numbers">
                                        <p class="card-category"
                                           style="text-align:center !important; font-size: 16px; "> Wallet to
                                            Wallet
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="activateBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#Activate">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-button-power text-success"></i>
                                    </div>
                                    <div class="numbers">
                                        <p class="card-category"
                                           style="text-align:center !important; font-size: 16px; ">Pay For Others</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="topupBtn" class=" col-md-3 col-sm-6 to-modal" data-toggle="modal" data-target="#Topup">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div style="margin:10px;">

                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-bank text-success"></i>
                                    </div>
                                    <div class="numbers">
                                        <p class="card-category"
                                           style="text-align:center !important; font-size: 16px; ">Top up</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($pin))
                        <div>
                            <h2>Generated Pin Card Information</h2>
                            <div class="codes">
                                {{ $pin }}
                            </div>
                        </div>
                    @endif
                    @include('includes.modal')
                </div>

            </div>
        </div>
    </div>
@endsection
