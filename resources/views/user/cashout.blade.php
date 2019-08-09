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
                                <li class="{{ active('cashout') }}"><a href="{{ route('cashout.show') }}">Cashout</a>
                                </li>
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

            <div class="content">
                <h2> Cashouts </h2>
                <div class="row">

                    @if(isset($cashouts))
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Previous Cashouts</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                            <th>
                                                Reference id
                                            </th>
                                            <th>
                                                Bank
                                            </th>

                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Rejected
                                            </th>
                                            <th>
                                                Completed
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach($cashouts as $cashout)
                                                <tr>
                                                    <td>{{ $cashout->ref_id }}</td>
                                                    <td>{{ $cashout->account->bank }}</td>
                                                    <td>{{ $cashout->amount }}</td>
                                                    <td>{{ $cashout->rejected?"yes":"no" }}</td>
                                                    <td>{{ $cashout->completed?"yes":"no" }}</td>
                                                    <td>{{ date('d M y',strtotime($cashout->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(auth()->user()->can_withdraw)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">New Request</h4>
                                    <p><strong>Note:</strong> we do not share private information to any third party.
                                        Every information is securely stored on a separate server.</p>
                                </div>
                                <div class="card-body">
                                    <div class="content">
                                        <form method="POST" action="{{ route('cashout.create') }}">
                                            @csrf
                                            @if(isset(auth()->user()->account) )
                                                <div class="form-group">
                                                    <label class="label" for="bank">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank" name="bank"
                                                           value="{{ auth()->user()->account->bank }}" required
                                                           readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label class="label" for="accountNumber">Account Number</label>
                                                    <input type="number" class="form-control" id="accountNumber"
                                                           name="account_number"
                                                           value="{{  auth()->user()->account->account_number }}"
                                                           required readonly/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="label" for="accountType">Account Type</label>
                                                    <input type="text" class="form-control" id="accountType"
                                                           name="account_type"
                                                           value="{{  auth()->user()->account->account_type }}" required
                                                           readonly/>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label class="label" for="bank">Bank Name</label>
                                                    <input type="text" class="form-control" id="bank" name="bank"
                                                           required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="label" for="accountNumber">Account Number</label>
                                                    <input type="number" class="form-control" id="accountNumber"
                                                           name="account_number" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="label" for="accountType">Account Type</label>
                                                    <select type="text" class="form-group custom-select"
                                                            id="accountType" name="account_type" required>
                                                        <option value="" selected>Select One</option>
                                                        <option value="savings">Savings</option>
                                                        <option value="current">Current</option>
                                                    </select>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="label" for="amount">Amount</label>
                                                @if(auth()->user()->wallet->special === 1)
                                                    <input type="tel" class="form-control"
                                                           value="{{ auth()->user()->wallet_total()+auth()->user()->wallet->special_bonus }}"
                                                           readonly/>
                                                @else
                                                    <input type="tel" class="form-control"
                                                           value="{{ auth()->user()->wallet_total() }}" readonly/>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary"><i
                                                            class="nc-icon nc-send"></i> Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
