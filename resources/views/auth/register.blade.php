@extends('layouts.script')

@section('content')

    <section class="testimonial py-5" id="testimonial" style="background-color: #fff !important">
        <h3 style="text-align:center">SIGNUP</h3>
        <div class="container" style="background-color: #fff !important">
            <div class="row ">
                <div class="col-md-4 py-5 bg-primary text-white text-center ">
                    <div class=" ">
                        <div class="card-body">
                            <img src="{{ asset('img/registration_bg.svg') }}" style="width:30%">
                            <h2 class="py-3">Registration</h2>
                            <p>Fil in all required field to ignite the process of beign a use of Goodnews

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 py-5 border">
                    <h4 class="pb-4">Please fill with your details</h4>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="name" placeholder="Full Name" class="form-control  @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email"  value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="Mobile" name="mobile" placeholder="Mobile No." class="form-control  @error('phone') is-invalid @enderror" required="required" type="text" value="{{ old('phone') }}" maxlength="11" autocomplete="mobile">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">

                                <select id="gender" name="gender" class="select form-control">
                                    <option value="" selected>Gender</option>
                                    <option value="M"> Male</option>
                                    <option value="F"> Female</option>

                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="none"  placeholder="confirm password">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                               required>
                                        <label class="form-check-label" for="invalidCheck2">
                                            <small>By clicking Submit, you agree to our Terms & Conditions, Visitor
                                                Agreement and Privacy Policy.
                                            </small>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <button type="submit" class="btn btn-block btn-info">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <div class="col-md-6 ">
                            <a class="text-primary" href="{{'/login'}}" style="font-size:14px;">
                                Login
                            </a>
                        </div>
                    </form>
                    <!-- <a  class="text-primary" href="{{'/login'}}" style="font-size:14px;">Login</a> -->

                </div>
            </div>
        </div>
    </section>
@endsection
