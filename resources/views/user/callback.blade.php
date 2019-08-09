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
            <!-- <div class="panel-header panel-header-sm"> </div> -->

            @if(isset($response))
            <div class="content">
                <h2>{{ ucwords($response->metadata->transaction) }} Transaction</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Transaction Id: {{ $response->id }}</h4>
                        <p>Reference: {{ $response->reference }}</p>
                        <p>Status: {{ $response->status }}</p>
                        <p>Amount: &#8358;{{ number_format($response->amount/100,2) }}</p>
                        <p>Fee: &#8358;{{ number_format($response->fees,2) }}</p>
                        <p>Account Email: {{ $response->customer->email }}</p>
                        <p>{{ date('d M Y h:m:s a',strtotime($response->paid_at)) }}</p>
                        <p></p>
                    </div>

                </div>
                <a  href="{{ ('/home') }}" class="btn btn-primary"><span class="nc-icon nc-bank"></span> Continue</a>
            </div>
            @endif
        </div>
    </div>

@endsection
