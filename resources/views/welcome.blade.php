@extends ('layout')

@section ('content')

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>ERROR!</strong> {{$errors->first()}}</a>.
                <h4></h4>
            </div>
        @endif
        <div class="flex-center position-ref full-height">

            <div class="content">

                @if (Session()->get('loggedIn'))
                    <script type="text/javascript">
                        window.location = "/cropper";
                    </script>
                @else
                    <p class="text-center">Use your RealPage network credentials to login</p><br>
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12 col-md-6 offset-md-3">
                          <form class="form-signin" method="POST" action="/">
                              {{ csrf_field() }}
                              <label for="inputEmail" class="sr-only">Email address</label>
                              <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                              <br />
                              <label for="inputPassword" class="sr-only">Password</label>
                              <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required><br>
                              <!-- <div class="checkbox">
                                  <label>
                                      <input type="checkbox" value="remember-me"> Remember me
                                  </label>
                              </div><br>-->
                              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                          </form>
                        </div>
                      </div>
                    </div>
                @endif


            </div>
        </div>

@endsection
