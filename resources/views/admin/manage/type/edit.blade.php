@extends('admin.main')

@section('content')

<form class="forms-sample" action="" method="POST" >
  <div class="card-body">

    <div class="form-group">
        <label >Tên loại sản phẩm</label>
        <input type="text" name="name" class="form-control" id="name"  value="{{$types->name}}">
    </div>

    <div class="form-group">
    <label>Hãng</label>
        <select name="id_brand" class="form-control">
        @foreach ($brands as $brand)
                <option 
                @if ($types->id_brand == $brand->id)
                    {{"selected"}}
                @endif
                value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group ">
        <label>Trạng thái</label>
        <div class="custom-control custom-radio">
            <input type="radio" value="1" id="status" name="status" class="custom-control-input"
            @if ($types->status == 1)
                {{"checked"}}
            @endif
            >
          <label for="status" class="custom-control-label">Hiện</label>

        </div>
    
        <div class="custom-control custom-radio">
            <input type="radio" value="0" id="no_status" name="status" class="custom-control-input"
            @if ($types->status == 0)
                {{"checked"}}
            @endif
            >
          <label for="no_status" class="custom-control-label">Ẩn</label>

        </div>
    </div>
    <button type="submit" class="btn btn-primary me-2">Sửa</button>
  </div>
    @csrf
</form>
    
@endsection