@extends('layouts.script')
@section('content')
@if (Route::has('login'))
    <div class="top-right links">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
@endif


<h3>DONT WORRY ABUT THIS PART, I GOT IT COVERED IT'S FOR ANOTHER USE, USE /LOGIN ROUTE</h3>
<div class="container">
   <div class="row">
     <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
       <div class="card card-signin my-5">
         <div class="card-body">
           <h5 class="card-title text-center">SIGN IN</h5>
           <form class="form-signin">
             <div class="form-group">
               <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required >
               <!-- <label for="inputEmail">Email address</label> -->
             </div>

             <div class="form-group">
               <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
               <!-- <label for="inputPassword">Password</label> -->
             </div>

             <div class="custom-control custom-checkbox mb-3">
               <input type="checkbox" class="custom-control-input" id="customCheck1">
               <label class="custom-control-label" for="customCheck1">Remember password</label>
             </div>
             <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
             <hr class="my-4">
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>


@endsection

<!-- Footer -->

<!-- Footer -->
