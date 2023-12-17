@extends('customer.main')
@section('content')
<section class="bg0 p-t-23 p-b-140 p-t-80">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                Tìm kiếm : {{$key}}
                
            </h3>
        </div>

        

        <div id="loadProduct">
            @include('customer.products.list')
        </div>


        <!-- Pagination -->
        <div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
            
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection
