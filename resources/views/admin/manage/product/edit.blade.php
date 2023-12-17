@extends('admin.main')

@section('head')
    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" id="name"  value="{{$products->name}}">
                </div>
                
                <div class="form-group">
                    <label >Loại sản phẩm</label>
                        <select id="id_type" name="id_type" class="form-control">
                            @foreach ($types as $type)
                            <option
                                @if ($products->id_type == $type->id)
                                    {{"selected"}} 
                                @endif
                                value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                </div>
                
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                <div class="form-group">
                <label>Hãng</label>
                    <select id="id_brand" name="id_brand" id="" class="form-control">
                        @foreach ($brands as $brand)
                            <option 
                            @if ($products->types->brands->id == $brand->id)
                                {{"selected"}} 
                            @endif
                            value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>Danh Mục</label>
                    <select class="form-control" name="id_menu">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" {{ $products->id_menu == $menu->id ? 'selected' : '' }}>
                                {{ $menu->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
               
        
                </div>
            </div>
           
        <div class="form-group">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" id="price"  value="{{$products->price}}">
        </div>


        <div class="form-group">
            <label>Số lượng sản phẩm</label>
            <input type="number" name="pro_quantity" class="form-control" id="pro_quantity"  value="{{$products->pro_quantity}}">
        </div>
        <div class="form-group ">
            <label>Mô tả sản phẩm</label>          
            <textarea  name="description" class="form-control ckeditor" id="ckeditor" placeholder="Nhập tóm tắt">{{$products->description}}</textarea>
        
        </div>
        
        <div class="form-group ">
            <label>Nội dung sản phẩm</label>
            <textarea  name="content" class="form-control ckeditor" id="ckeditor" placeholder="Enter content">{{$products->content}}</textarea>
            
        </div>
        
        <div class="form-group ">
            <label>Ảnh sản phẩm</label>
            <div>
                <img src="/upload/product/{{$products->image}}" width="200px"> <br><br>
                <input type="file" name="image" class="form-control" id="image" >
            </div>
        </div>

        <div class="form-group ">
            <label>Ảnh mô tả sản phẩm</label>
            <div>
                <div class="row">
                    @foreach ($img_pro as $img_pro)
                        <div class="col-md-5">
                            <div class="thunbnail">
                                <img src="/upload/product/{{$img_pro->sub_photo}}" height="200px"> <br><br>
                            </div>

                        </div>
                    @endforeach
                </div>
                <input type="file" name="imageList[]" class="form-control" multiple >
            </div>
        </div>

        <div class="form-group ">
            <label>Trạng thái</label>
            <div class="custom-control custom-radio">
                <input type="radio" value="1" id="status" name="status" class="custom-control-input"
                @if ($products->status == 1)
                    {{"checked"}}
                @endif
                >
                 <label for="status" class="custom-control-label">Hiện</label>

            </div>
        
            <div class="custom-control custom-radio">
                <input type="radio" value="0" id="no_status" name="status" class="custom-control-input"
                @if ($products->status == 0)
                    {{"checked"}}
                @endif
                >
            <label for="status" class="custom-control-label">Ẩn</label>

            </div>
        </div>
        <button type="submit" class="btn btn-primary me-2">Sửa</button>
        </div>
        </div>
        </div>
    </form>
    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#id_brand").change(function(){
                var id = $(this).val();
                $.get("/admin/ajax/type/"+id,function(data){
                    $("#id_type").html(data);
                });
            });
        });
    </script>
@endsection


@section('footer')
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>
    
@endsection

