@extends('admin.main')

@section('content')
        <table class="table" id='myTable'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->name}}</td>
                        <td>
                            @if($menu->parent_id == 0)
                            {!! '<span class="btn btn-primary btn-sm">Danh mục cha</span>'; !!}
                            @else
                            {!! '<span class="btn btn-primary btn-sm">Danh mục con</span>'; !!}
                            @endif
                        </td>
                        <td>                    
                        @if ($menu->status == 0 )
                            {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else
                        {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                        </td>

                        <td>
                            <a href="/admin/manage/menus/edit/{{$menu->id}}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>         
                            </a>

                            <a href="/admin/manage/menus/delete/{{$menu->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa ?')">
                                <i class="fas fa-trash"></i>      
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
@endsection