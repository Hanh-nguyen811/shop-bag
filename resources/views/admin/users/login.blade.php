<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.head')
</head>
<body class="hold-transition login-page" 
>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-body">
      @include('admin.alert')
      <p class="login-box-msg" class="h2">Đăng nhập</p>
      <form action="/admin/users/login/store" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Nhập Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Nhập Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
            <label class="form-check-label" for="remember-me">
                Ghi nhớ
            </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">ĐĂNG NHẬP</button>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- End login-box -->

@include('admin.footer')
</body>
</html>
