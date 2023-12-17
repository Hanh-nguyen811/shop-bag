@extends('admin.main')

@section('content')
    <table class="table" id='myTable'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{$brand->id}}</td>
                    <td>{{$brand->name}}</td>
                    <td>                    
                        @if ($brand->status == 0 )
                            {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else 
                            {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                    </td>
                    
                    <td>
                        <a href="/admin/manage/brands/edit/{{$brand->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>         
                        </a>

                        <a href="/admin/manage/brands/delete/{{$brand->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa ?')">
                            <i class="fas fa-trash"></i>      
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection