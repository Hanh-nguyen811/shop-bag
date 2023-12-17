@extends('admin.main')

@section('content')
    <table class="table" id='myTable'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên tin tức</th>
                {{-- <th>Tóm tắt</th> --}}
                <th>Trạng thái</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $new)
                 <tr>
                    <td>{{$new->id}}</td>
                    <td>
                        <p>{{$new->title}}</p>
                        <img src="/upload/new/{{$new->image}}" alt="" width="100px">
                    </td>
                    {{-- <td>{!!$new->description!!}</td> --}}

                    <td>                    
                        @if ($new->status == 0 )
                            {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else
                        {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                    </td>

                    
                    <td>
                        <a href="/admin/manage/news/edit/{{$new->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>         
                        </a>
                        <a href="/admin/manage/news/delete/{{$new->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa không khôi phục?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

@endsection