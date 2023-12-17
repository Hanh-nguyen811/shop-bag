@extends('admin.main')

@section('head')
    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
    
<form action="" method="POST" enctype="multipart/form-data">
@csrf
<div class="card-body">
    <div class="form-group">
        <label>Tên tin tức</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Tên tin tức">
    </div>
<div class="form-group ">
    <label>Mô tả tin tức</label>  
    <textarea  name="description" class="form-control" id="ckeditor" placeholder="Nhập tóm tắt">{{old('description')}}</textarea>
    
</div>

<div class="form-group ">
    <label>Nội dung tin tức</label>   
    <textarea  name="content" class="form-control ckeditor" id="ckeditor" placeholder="Nhập nội dung">{{old('content')}}</textarea>
    
</div>

<div class="form-group ">
    <label>Ảnh tin tức</label>
    <div>
        <input type="file" name="image" class="form-control" id="image" >
    </div>
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



</div>


</div>
</div>
</form>

@endsection
@section('footer')
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>
    
@endsection


