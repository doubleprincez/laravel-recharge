@extends('layouts.script')
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
                        <img src="{{ asset(auth()->user()->avatar) }}">
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
                            <li class="nav-item"> <?php if(auth()->user()->isAdmin == 1){?> <a href="{{url('cpanel/admin-page')}}">Admin</a> <?php } else echo ' Normal User ';?></li>
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
            <!-- <div class="panel-header panel-header-sm"> </div> -->


            <div class="content">
                {{--<h2>Level: {{ auth()->user()->referral_level }}</h2>--}}
                {{--<div class="row">--}}
                {{--<h5> Referred by: &nbsp;{{ auth()->user()->referred_by() }} </h5>--}}


                {{--name phone ref_id date_joined(created_at)--}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Transactions</h2>
                        </div>
                        <div class="card-body">
                            @if(isset($transactions) &&  $transactions->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>Id</th>
                                        <th>Reference</th>
                                        <th>Type</th>
                                        <th>Service Id</th>
                                        <th>Amount</th>
                                        <th>Paid At</th>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $ref)
                                            <tr>
                                                <td>{{ $ref->id }}</td>
                                                <td> {{ $ref->reference }} </td>
                                                <td>{{ $ref->type }}</td>
                                                <td>{{ $ref->service_id }}</td>
                                                <td> &#8358;{{ number_format($ref->amount,2) }}  </td>
                                                <td> {{ date('d M Y',strtotime($ref->paid_at)) }} </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="content align-content-center text-center">
                                    <h4><span class="fa fa-folder-o"></span> No Transactions Yet </h4>
                                </div>

                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>

@endsection
