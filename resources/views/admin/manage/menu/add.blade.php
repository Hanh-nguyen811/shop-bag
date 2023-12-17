@extends('admin.main')

@section('content')

<form class="forms-sample" action="" method="POST" >
  <div class="card-body">
    <div class="form-group">
        <label for="menu">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Tên danh mục">
    </div>

    <div class="from-gruop">
        <label for="menu">Danh mục</label>
        <select name="parent_id" id="" class="form-control">
          <option value="0">Danh mục cha</option>
          @foreach ($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->name}}</option>
          @endforeach
        </select>
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