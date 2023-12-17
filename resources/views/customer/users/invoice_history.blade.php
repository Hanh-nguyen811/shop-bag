@extends('customer.main')
@section('content')
<section class="bg0 p-t-104 p-b-116 p-t-80">

<div class="container">
    <table class="table"  id='myTable'>
        <thead>
        <tr>
            <th>Tên Khách Hàng</th>
            <th>Số Điện Thoại</th>
            <th>Trạng thái</th>
            <th>Ngày Đặt hàng</th>
            
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                @if ($invoice->id_customer == Null)
                @else
                    <td>{{$invoice->customers->name}}</td>
                    <td>{{ $invoice->customers->phone }}</td>
                    <td>
                        @php
                            $arrStatus = array(0=>"",1=>"",-1=>"",2=>"",3=>"");
                            echo $arrStatus[$invoice->status]; 
                            
                        @endphp
    
                        @if ( $invoice->status == 0)
                            {!! '<span class="btn btn-danger btn-xs">Chưa duyệt</span>'; !!}   
                        @elseif ($invoice->status == 1)
                            {!! '<span class="btn btn-success btn-xs">Đã duyệt </span>'; !!}  
                        @elseif($invoice->status == 2)
                            {!! '<span class="btn btn-success btn-xs">Đang giao </span>'; !!}  
                        @elseif ($invoice->status == 3)
                        {!! '<span class="btn btn-success btn-xs">Đơn hàng hoàn thành</span>'; !!}
                        @else 
                            {!! '<span class="btn btn-danger btn-xs">Hủy </span>'; !!}    
                        @endif
    
                     
                    </td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/don-hang/{{ $invoice->id }}">
                            <i class="fa fa-eye"aria-hidden="true"></i></a>

                        </a>
                    
                    
                    </td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</section>
@endsection

