@extends('layouts.admin.script')
@section('content')


  <body class="login">
    <div>
    
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="{{ url('login') }}">Log in</a>

              </div>

              <div class="clearfix"></div>

              <div class="separator">


                <div class="clearfix"></div>



              </div>
            </form>
          </section>
        </div>


      </div>
    </div>
  </body>

@endsection
