@extends('customer.main')
@section('content')
    <section class="bg0 p-t-104 p-b-116 p-t-80">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md container-fluid">
                    @include('admin.alert')
                    <form class="pt-3" method="POST" action="dang-ky">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                          Đăng ký
                        </h4>

                        @csrf
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Họ tên</label>
                            <input type="text" class="form-control"  placeholder="Họ tên" name="name">
                        </div>

                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" name="phone" placeholder="Số điện thoại">
                          </div>
                    
                        <div class="col-md-12">
                          <label for="inputEmail4" class="form-label">Email</label>
                          <input type="email" class="form-control"  name="email" placeholder="Email">
                        </div>
                        <div class="col-md-12">
                          <label for="inputPassword4" class="form-label">Mật khẩu</label>
                          <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Mật khẩu">
                        </div>
                        <div class="col-12">
                          <label for="inputAddress" class="form-label">Địa chỉ</label>
                          <input type="text" class="form-control" name="address" id="inputAddress" placeholder="Địa chỉ">
                        </div>

                        <div class="my-2 d-flex justify-content-between align-items-center">
                          <div class="form-check">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                          </div>
                          <div class="form-check">
                            <a href="/dang-nhap">Đăng nhập</a>
                          </div>
                      </div>
                        
                    
                    </form>
				</div>

			</div>
		</div>
	</section>	
    
@endsection
