@extends('admin.main')

@section('content')
    
<form action="" method="POST" enctype="multipart/form-data">
@csrf
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="name" class="form-control" id="name"  value="{{$sliders->name}}">
        </div>
        </div>
        <!-- /.form-group -->
        <div class="col-md-6">
        <div class="form-group">
            <label>Đường dẫn</label>
            <input type="text" name="url" class="form-control" id="url" value="{{$sliders->url}}">
        </div>
        <!-- /.form-group -->
        </div>
    </div>
</div>

<div class="card-body">

<div class="form-group ">
    <label>Ảnh sản phẩm</label>
    <img src="/upload/slider/{{$sliders->image}}" width="300px"> <br><br>
    <input type="file" name="image" class="form-control" id="image" >
   
</div>

<div class="form-group ">
    <label>Sắp xếp</label>
    <input type="number" name="sort_by" class="form-control"  value="{{$sliders->sort_by}}">

</div>

<div class="form-group ">
    <label>Trạng thái</label>
    <div class="custom-control custom-radio">
        <input type="radio" value="1" id="status" name="status" class="custom-control-input"
        @if ($sliders->status == 1)
            {{"checked"}}
        @endif
        >
      <label for="status" class="custom-control-label">Hiện</label>

    </div>

    <div class="custom-control custom-radio">
        <input type="radio" value="0" id="no_status" name="status" class="custom-control-input"
        @if ($sliders->status == 0)
            {{"checked"}}
        @endif
        >
      <label for="no_status" class="custom-control-label">Ẩn</label>

    </div>
</div>


<button type="submit" class="btn btn-primary me-2">Sửa</button>

</div>

</div>
</div>

</form>

@endsection
