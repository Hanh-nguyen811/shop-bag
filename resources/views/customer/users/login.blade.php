@extends('customer.main')
@section('content')
<section class="bg0 p-t-104 p-b-116 p-t-80">
<div class="container">
  <div class="flex-w flex-tr">
    <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md container-fluid">
      <form class="pt-3" method="POST" action="dang-nhap">
        @include('admin.alert')
            <h4 class="mtext-105 cl2 txt-center p-b-30">
            Đăng nhập
            </h4>

        @csrf
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg"  placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg"  placeholder="Mật khẩu">
        </div>
        
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                  Ghi nhớ 
                </label>
            </div>
            <div class="form-check">
              <a href="/dang-ky">Tạo tài khoản mới</a>
            </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >Đăng nhập</button>
        </div>
            
      </form>
    </div>

  </div>
</div>
</section>	
    
@endsection
