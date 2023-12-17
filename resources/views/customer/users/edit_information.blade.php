@extends('customer.main')
@section('content')

    <section class="bg0 p-t-104 p-b-116 p-t-80">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md container-fluid">
                    <form class="pt-3" method="POST">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                          Sửa thông tin cá nhân
                        </h4>

                        @csrf
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Họ tên</label>
                            <input type="text" class="form-control"  name="name" value="{{Auth::guard('customer')->user()->name}}">
                        </div>

                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Số điện thoại</label>
                            <input type="number" class="form-control" name="phone" value="{{Auth::guard('customer')->user()->phone}}">
                          </div>
                    
                        <div class="col-md-12">
                          <label for="inputEmail4" class="form-label">Email</label>
                          <input type="email" class="form-control"  name="email" value="{{Auth::guard('customer')->user()->email}}">
                        </div>
                        <div class="col-md-12">
                          <label for="inputPassword4" class="form-label">Mật khẩu</label>
                          <input type="password" class="form-control" id="inputPassword4" name="password" value="{{Auth::guard('customer')->user()->password}}">
                        </div>
                        <div class="col-12">
                          <label for="inputAddress" class="form-label">Địa chỉ</label>
                          <input type="text" class="form-control" name="address" value="{{Auth::guard('customer')->user()->address}}">
                        </div>

                        <div class="my-2 d-flex justify-content-between align-items-center">
                          <div class="form-check">
                            <button type="submit" class="btn btn-primary">Lưu</button>

                          </div>
                          
                        
                      </div>
                        
                    
                    </form>
				</div>

			</div>
		</div>
	</section>	
    
@endsection
