<!DOCTYPE html>
<html lang="en">

<head>

  @include('admin-layouts.meta')
  @include('admin-layouts.css')
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Please Sign In</h3>
          </div>
          <div class="panel-body">
            <form action="/login" method="POST">
              @csrf
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="">
                </div>
                {{-- <div class="checkbox">
                  <label>
                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                  </label>
                </div> --}}
                <div class="form-group">
                    <a className="form-control" href="/register">Sign Up</a>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('admin-layouts.script')
</body>

</html>