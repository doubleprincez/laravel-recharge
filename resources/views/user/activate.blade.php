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
                <!-- <div class="logo-image-big">
            <img src="{{asset('img/logo-small.png')}}">
          </div> -->
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

            <div class="content">
                <h2>Account Activation Required</h2>
                <div class="">
                    <div class="card-title">
                        <h4>Kindly Activate your account now to access all services provided</h4>
                    </div>
                    <div class="">
                        @if(isset($prev_transactions) && $prev_transactions->count()>0)
                            <div class="">
                                <table class="table table-responsive">
                                    <tr>  <td>Installment:</td> <td> Amount:</td>
                                        <td>Balance:</td>  <td> Customer Code:</td> <td>Reference:</td>
                                        <td>Transaction Id:</td>  <td> Status:</td> <td>Paid At:</td>
                                    </tr>
                                    @foreach($prev_transactions as $index => $item)
                                        <tr>
                                        <td>{{ $item->installment }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td> {{ $item->balance }}</td>
                                        <td> {{ $item->customer_code }}</td>
                                        <td>{{$item->reference}}</td>
                                        <td> {{ $item->transaction_id }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td> {{ date('d M Y',strtotime($item->paid_at)) }}</td>
                                    </tr>

                                    @endforeach
                                </table>


                                <form method="post" action="{{ route('activate') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required  readonly value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" readonly required value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" readonly required value="{{ auth()->user()->mobile}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount </label>
                                        <input type="text" class="form-control" name="amount" required  value=" ">
                                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['transaction' => 'activate','installment'=>'1']) }}">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                    </div>


                                    <div class="form-group">
                                        <button class="btn btn-secondary" type="submit"><i class="nc-icon nc-key-25"></i> Activate</button>
                                    </div>

                                </form>

                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-10">
                                    <span>An Activation fee of <strong>&#8358;{{ number_format(config('app.activation_fee')) }}</strong> is required to complete account verification and activation</span>
                                    <div>
                                        <form method="post" action="{{ route('activate') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">User Name</label>
                                                <input type="text" class="form-control" id="name" name="name" required  readonly value="{{ auth()->user()->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" readonly required value="{{ auth()->user()->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" readonly required value="{{ auth()->user()->mobile}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount <span id="info" class="alert alert-info small" style="display: none;"> Enter the amount you will like to pay</span> </label>
                                                <input type="text" class="form-control" id="amount" name="amount" required readonly value="{{ config('app.activation_fee') }}">
                                                <input type="hidden" name="metadata" id="metadata" value="{{ json_encode($array = ['transaction' => 'activate','installment'=>0]) }}">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" class="checkbox-inline" id="installment" onchange="setInstallment()">Pay Installmentally?
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-secondary" type="submit"><i class="nc-icon nc-key-25"></i> Activate</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

    <script>
        function setInstallment( ){
        let amount = $('#amount'); let info = $('#info');
        let metadata = $('#metadata');
        let check = document.getElementById("installment").checked;

        if(check === true){
            amount.removeAttr('readonly');
            metadata.val( JSON.parse("{transaction:'activate',installment:'1'}"));
            info.show();
        }else{
            info.hide();
            metadata.val(JSON.parse("{transaction:'activate',installment:'0'}"));
            amount.attr('readonly','readonly');
        }
        }</script>
@endsection
