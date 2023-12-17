@extends('admin.main')

@section('content')
    <table class="table" id='myTable'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Hãng</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{$type->id}}</td>
                    <td>{{$type->name}}</td>
                    <td>{{$type->brands->name}}</td>
                    <td>                    
                        @if ($type->status == 0 )
                            {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else
                        {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                        </td>
                    <td>
                        <a href="/admin/manage/types/edit/{{$type->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>           
                        </a>

                        <a href="/admin/manage/types/delete/{{$type->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa ?')">
                            <i class="fas fa-trash"></i>         
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection