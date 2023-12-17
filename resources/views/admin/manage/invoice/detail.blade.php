@extends('admin.main')

@section('content')
<div class="row">

    <div class="col-md-4">
        @foreach($invoices as $invoice)

        @if ($invoice->id_customer == Null)
            <h3>Thông tin khách hàng(Trống)</h3>
            <p>Khách vãng lai</p>
        @else
            <h3>Thông tin khách hàng</h3>
            <ul>
                <li>Tên khách hàng: <strong>{{ $invoice->customers->name }}</strong></li>
                <li>Số điện thoại: <strong>{{ $invoice->customers->phone }}</strong></li>
                
            </ul>
        @endif
        @endforeach
    </div>


    <div class="col-md-4">
        <h3>Thông tin vận chuyển</h3>
        <ul>
            <li>Tên khách hàng: <strong>{{ $shipping->name }}</strong></li>
            <li>Số điện thoại: <strong>{{ $shipping->phone }}</strong></li>
            <li>Địa chỉ: <strong>{{ $shipping->address }}</strong></li>
            <li>Email: <strong>{{ $shipping->email }}</strong></li>
            <li>Ghi chú: <strong>{{ $shipping->note }}</strong></li>
            
        </ul>
    </div>

    <div class="col-md-4">
        <label>Trạng thái đơn hàng: </label>

        @foreach($invoices as $invoice)
        @if($invoice->status==2)
        <form>
            @csrf
            <select class="form-control order_details">
                <option value="">----Chọn hình thức đơn hàng-----</option>
                <option id="{{$invoice->id}}" value="1">Duyệt đơn</option>
                <option id="{{$invoice->id}}" selected value="2">Đang giao hàng</option>
            </select>
        </form>
        @elseif($invoice->status==1)
            <form>
                @csrf
                <select class="form-control order_details">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$invoice->id}}" selected value="1">Duyệt đơn</option>
                    <option id="{{$invoice->id}}" value="2">Đang giao hàng</option>
                </select>
            </form>
        @elseif($invoice->status== -1)
            {!! '<span class="btn btn-danger btn-xs">Đơn đã bị hủy </span>'; !!}    
        @elseif($invoice->status== 3)
            {!! '<span class="btn btn-success btn-xs">Đơn hàng hoàn thành </span>'; !!}    
        @else
        <form>
            @csrf
            <select class="form-control order_details">
                <option value="">----Chọn hình thức đơn hàng-----</option>
                <option id="{{$invoice->id}}" value="1">Duyệt đơn</option>
                <option id="{{$invoice->id}}" value="2">Đang giao hàng</option>
            </select>
        </form>
        @endif
        @endforeach
        
    </div>


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
                        <img src="/upload/product/{{$invoice->products->image}} " height="100px" >
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
@endsection