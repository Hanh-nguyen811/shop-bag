@extends('admin.main')

@section('content')

<form class="forms-sample" action="" method="POST" >
  <div class="card-body">
    <div class="form-group">
        <label for="brand">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name" value="{{$menus->name}}">
    </div>

    <div class="form-group">
      <label>Danh Mục</label>
      <select class="form-control" name="parent_id">
          <option value="0" {{ $menus->parent_id == 0 ? 'selected' : '' }}> Danh Mục Cha </option>
          @foreach($menu as $menuParent)
              <option value="{{ $menuParent->id }}"
                  {{ $menus->parent_id == $menuParent->id ? 'selected' : '' }}>
                  {{ $menuParent->name }}
              </option>
          @endforeach
      </select>
    </div>

    <div class="form-group ">
        <label>Trạng thái</label>
        <div class="custom-control custom-radio">
            <input type="radio" value="1" id="status" name="status" class="custom-control-input"
            @if ($menus->status == 1)
                {{"checked"}}
            @endif
            >
          <label for="status" class="custom-control-label">Hiện</label>
        </div>
    
        <div class="custom-control custom-radio">
            <input type="radio" value="0" id="no_status" name="status" class="custom-control-input"
            @if ($menus->status == 0)
                {{"checked"}}
            @endif
            >
          <label for="no_status" class="custom-control-label">Ẩn</label>

        </div>
    </div>
    <button type="submit" class="btn btn-primary me-2">Sửa</button>
    @csrf
  </div>
</form>
    
@endsection