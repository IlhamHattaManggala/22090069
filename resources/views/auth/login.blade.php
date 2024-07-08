<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page | {{ $website->nama }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <link href="{{ $website->base64Image }}" rel="icon">

</head>

<body class="hold-transition login-page" style="background-image: url('AdminLTE/dist/img/parallax1.png'); background-size: cover;">
  <div class="login-box">
    <div class="login-form">
      <div class="text-center">
        <a href="{{ route('login') }}" class="h1 text-white"><b>ihGamers!</b></a>
      </div>
      <p class="login-box-msg text-white"><b>Silahkan Login Terlebih Dahulu</b></p>

      <form action="{{ route('login-proses') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
        <small>{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
        <small>{{ $message }}</small>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember" style="color: white">
                Ingat saya
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="{{ route('register') }}" class="btn btn-secondary btn-block text-center">Buat Akun Baru?</a>
        <div class="row mt-2">
          <div class="col-md-6">
            <a href="{{ route('login.facebook') }}" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Login Facebook
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{ route('login.google') }}" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Login Google+
            </a>
          </div>
        </div>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('forgot-password') }}" class="text-white"><b>Lupa Password?</b></a>
      </p>
    </div>
    <!-- /.login-form -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
