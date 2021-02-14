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
            <h3 class="panel-title">Please Fill Form</h3>
          </div>
          <div class="panel-body">
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}"
              enctype="multipart/form-data">
              @csrf
              <fieldset>
                <div class="form-group">
                  <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                    value="{{ old('name') }}" placeholder="Name" required autofocus>
                  @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif

                </div>
                <div class="form-group">
                  <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                    value="{{ old('email') }}" required" placeholder="E-mail">
                  @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif

                </div>
                <div class="form-group">
                  <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password"
                    name="password" type="password" required>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Password Confirmation" name="password_confirmation"
                    type="password">
                </div>
                {{-- <div class="form-group row  {{ $errors->has('avatar') ? ' is-invalid' : '' }}">
                <div class="col-md-12">
                  <input id="avatar" type="file" class="form-control" name="avatar">
                </div>
                @if ($errors->has('avatar'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('avatar') }}</strong>
                </span>
                @endif
          </div> --}}
          <!-- Change this to a button or input when using this as a form -->
          <div class="form-submit">
            <button class="btn btn-lg btn-success btn-block">Register</button>
          </div>
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