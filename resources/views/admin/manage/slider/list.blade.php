@extends('admin.main')

@section('content')
    <table class="table" id='myTable'>
        <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th style="width:100px">Link</th>
            <th>Trạng thái</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                 <tr>
                    <td>{{$slider->id}}</td>
                    <td>
                        <p>{{$slider->name}}</p>
                        <img src="/upload/slider/{{$slider->image}}" alt="" width="200px">
                    </td>
                    <td>{{$slider->url}}</td>
                    <td>                    
                        @if ($slider->status == 0 )
                            {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else 
                            {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                        </td>
                    <td>
                        <a href="/admin/manage/sliders/edit/{{$slider->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>         
                        </a>
                        <a href="/admin/manage/sliders/delete/{{$slider->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa không khôi phục?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

    
@endsection