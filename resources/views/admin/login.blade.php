@extends('layouts.script')
<body style="background-image: url('img/bg.jpg');  ">
@section('content')
<div class=”container”>@if(\Session::has('error'))<div class="alert alert-danger">{{\Session::get('error')}}</div>@endif
<div class="container" style="margin:0 auto; padding-top:10%">
   <div class="row">
     <div class="col-sm-8 col-md-7 col-lg-5 mx-auto" >
       <div class="card card-signin my-5">
         <div class="card-body">
           <h5 class="card-title text-center" style="font-size:25px;"><b>SIGN IN</b></h5>

             <form class="form-signin" method="POST" action="{{ route('login') }}">
                 @csrf
             <div class="form-group">
               <input class="form-control" name="mobile" placeholder="Provide Mobile Number"  autofocus required>
               <!-- <label for="inputEmail">Email address</label> -->
             </div>

             <div class="form-group">
               <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="provide password">
               <!-- <label for="inputPassword">Password</label> -->
             </div>

             <div class="custom-control custom-checkbox mb-3">
               <input type="checkbox" class="custom-control-input" id="customCheck1">
               <label class="custom-control-label" for="customCheck1" style="font-size:14px;">Remember password</label>
             </div>
             <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Login') }}</button>

             <hr class="my-4">
           </form>

            <a  class="text-primary" href="{{'/register'}}" style="font-size:14px;">Create an account</a>
         </div>
       </div>
     </div>
   </div>
 </div>

 @endsection
