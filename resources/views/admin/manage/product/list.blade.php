@extends('admin.main')

@section('content')
    <table class="table" id='myTable'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Hãng sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Giá</th> 
                <th>Trạng thái</th>
                <th>Active</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
                 <tr>
                    <td>{{$product->id}}</td>
                    <td>
                        <p>{{$product->name}}</p>
                        <img src="/upload/product/{{$product->image}}" height="100px" >
                    </td>
                    <td>{{ $product->pro_quantity }}</td>

                    <td>{{$product->brands->name}}</td>
                    <td>{{$product->types->name}}</td>
                    <td>{{ number_format($product->price, 0, '', '.') }}</td>
                    <td>
                        @if ($product->status == 0 )
                        {!! '<span class="btn btn-danger btn-xs">Ẩn</span>'; !!}
                        @else
                        {!! '<span class="btn btn-success btn-xs">Hiện</span>'; !!}
                        @endif
                    </td>
                    

                    <td>
                        <a href="/admin/manage/products/edit/{{$product->id}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>         
                        </a>
                        <a href="/admin/manage/products/delete/{{$product->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc xóa không khôi phục?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>
@endsection