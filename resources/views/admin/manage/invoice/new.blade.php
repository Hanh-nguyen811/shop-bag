@extends('admin.main')

@section('content')
    <table class="table"  id='myTable'>
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
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
                <td>{{$invoice->shippings->id}}</td>
                <td>{{$invoice->shippings->name}}</td>
                <td>{{ $invoice->shippings->phone }}</td>

                <td>
                    @php
                        $arrStatus = array(0=>"",1=>"",-1=>"",2=>"",-2=>"",3=>"");
                        echo $arrStatus[$invoice->status]; 
                        
                    @endphp

                    @if ( $invoice->status == 0)
                        {!! '<span class="btn btn-danger btn-xs">Đơn chưa duyệt</span>'; !!}          
                    @endif

                 
                </td>
                <td>{{ $invoice->date }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/manage/customers/view/{{ $invoice->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                   
                   
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    
@endsection

