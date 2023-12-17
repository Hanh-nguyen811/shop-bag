@extends('customer.main')
@section('content')
<section class="bg0 p-t-104 p-b-116 p-t-80">

<div class="container">
    @include('admin.alert')
    <div class="col-md-4">
        <label>Trạng thái đơn hàng: </label>

        @foreach($invoices as $invoice)
            @if($invoice->status==3)
                {!! '<span class="btn btn-success btn-xs">Đơn hàng hoàn thành </span>'; !!}
            @elseif($invoice->status==-1)
                {!! '<span class="btn btn-danger btn-xs">Đơn đã bị hủy </span>'; !!}    

            @elseif($invoice->status== 1)
                {!! '<span class="btn btn-success btn-xs">Đã duyệt </span>'; !!}    
            @elseif($invoice->status== 2)
            <a class="btn btn-danger btn-xs" href="/xac-nhan/{{ $invoice->id }}">
                {!! '<span >Đã nhận hàng</span>'; !!}         
            </a>       
            @else
            <a class="btn btn-danger btn-xs" href="/huy-don/{{ $invoice->id }}">
                {!! '<span >Hủy</span>'; !!}         
            </a>
            @endif
        @endforeach
        
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Ảnh</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng</th>
    
            </tr>
            @foreach($invoice_detail as $invoice)
                @php
                    $price = $invoice->price * $invoice->quantity;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="/upload/product/{{$invoice->products->image}} ">
                        </div>
                    </td>
                    <td class="column-2">{{ $invoice->products->name }}</td>
                    <td class="column-3">{{ number_format($invoice->price, 0, '', '.') }}</td>
                    <td class="column-4">
                        <input type="number" min="1" class="order_qty_{{$invoice->id_product}}" value="{{$invoice->quantity }}" name="product_sales_quantity">
          
                        <input type="hidden" name="order_product_id" class="order_product_id" value="{{$invoice->id_product}}"> 
                      </td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                    
                    
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng Tiền</td>
                    <td>{{ number_format($total, 0, '', '.') }}</td>
                </tr>
            
            
            </tbody>
        </table>
        
    </div>

</div>
</section>
@endsection

