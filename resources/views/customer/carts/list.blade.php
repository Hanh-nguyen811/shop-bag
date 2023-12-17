@extends('customer.main')

@section('content')
    <form class="bg0 p-t-130 p-b-85" method="post">
        @csrf
        @include('admin.alert')

        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table-shopping-cart">
                                    <tbody>
                                    <tr class="table_head">
                                        <th class="column-1">Sản phẩm</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Giá</th>
                                        <th class="column-4">Số lượng</th>
                                        <th class="column-5">Tổng</th>
                                        <th class="column-6">&nbsp;</th>
                                    </tr>

                                    @foreach($products as $product)
                                        @php
                                            $price = $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="/upload/product/{{$product->image}} " alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{ $product->name }}</td>
                                            <td class="column-3">{{ number_format($price)}}đ</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"  ></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" 
                                                           name="num_product[{{ $product->id }}]" value="{{ $carts[$product->id] }}" min="1">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">{{ number_format($priceEnd)}}đ</td>
                                            <td class="p-r-15">
                                                <a class="btn btn-danger btn-sm" href="/carts/delete/{{ $product->id }}">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                                <input type="submit" value="Cập nhật giỏ hàng" formaction="/update-cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">

                                    <div
                                        class="flex-c-m stext-101 cl2 size-119 p-lr-15 trans-04 ">
                                        Tổng:
                                        <span class="mtext-110 cl2">
                                            {{ number_format($total, 0, '', '.') }}đ
                                        </span>
                                    </div>
                                    
                                
                            </div>

                            
                            
                            
                        </div>

                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">

                                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

                                   
                                    <div class="p-t-15">
                                        @if (Auth::guard('customer')->check())
                                        <form action="/carts" method="post">
                                            @csrf
                                            <h4 class="mtext-109 cl2 p-b-30">
                                                Thông tin thanh toán
                                            </h4>
                                            <div class=" bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách Hàng" value="{{Auth::guard('customer')->user()->name}}" >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại" value="{{Auth::guard('customer')->user()->phone}}" >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ " value="{{Auth::guard('customer')->user()->address}}" >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email " value="{{Auth::guard('customer')->user()->email}}" >
                                            </div>
    
    
                                            <div class="bor8 bg0 m-b-12">
                                                <textarea class="cl8 plh3 size-111 p-lr-15" name="note" placeholder="Ghi chú"></textarea>
                                            </div>
                                        </form>
                                        @else
                                            
                                        <form action="/carts" method="post">
                                            @csrf
                                            <h4 class="mtext-109 cl2 p-b-30">
                                                Thông tin thanh toán
                                            </h4>
                                            <div class=" bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Họ và tên" >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số điện thoại" >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa chỉ " >
                                            </div>
    
                                            <div class="bor8 bg0 m-b-12">
                                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email " >
                                            </div>
                                            <div class="bor8 bg0 m-b-12">
                                                <textarea class="cl8 plh3 size-111 p-lr-15" name="note" placeholder="Ghi chú"></textarea>
                                            </div>
                                        </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-check ">
                                <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                    Đặt hàng
                                    </button>
                            </div>
                        </div>            
                    </div>
                </div>

                    </div>
                    
                                    

                </div>
            </div> 
    </form>

    @else
        <div class="text-center"><h2>Chưa có sản phẩm nào trong giỏ</h2></div>
    @endif
@endsection