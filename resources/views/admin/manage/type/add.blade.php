@extends('admin.main')

@section('content')

<form class="forms-sample" action="" method="POST" >
    <div class="card-body">
        <div class="form-group">
            <label>Tên loại sản phẩm</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Tên loại sản phẩm">
        </div>

        <div class="form-group">
            <label >Hãng sản phẩm</label>
            <div class="col-sm-10">
                <select name="id_brand" class="form-control">
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
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
    @csrf
    </div>
</form>
    
@endsection