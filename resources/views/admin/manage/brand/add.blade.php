@extends('admin.main')

@section('content')

<form class="forms-sample" action="" method="POST" >
  <div class="card-body">
    <div class="form-group">
        <label for="brand">Tên hãng</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên hãng">
    </div>

    <div class="form-group ">
      <label>Trạng thái</label>
      <div class="custom-control custom-radio">
          <input type="radio" value="1" id="status" name="status" checked="" class="custom-control-input">
          <label for="status" class="custom-control-label">Hiện</label>
      </div>
  
      <div class="custom-control custom-radio">
          <input type="radio" value="0" id="no_status" name="status" class="custom-control-input">
          <label for="no_status" class="custom-control-label">Ẩn</label>
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary me-2">Thêm</button>
    @csrf
  </div>
</form>
    
@endsection