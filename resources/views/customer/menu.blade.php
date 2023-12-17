@extends('customer.main')
@section('content') 
<div class="bg0 m-t-23 p-b-140 p-t-80">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
               <h1>{{ $title }}</h1>
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Lọc
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Tìm kiếm
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <form action="/search" method="get">
                    @csrf
                    <div class="bor17 of-hidden pos-relative">
                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="key" placeholder="Tìm kiếm">

                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Sắp xếp theo
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{ request()->url() }}" class="filter-link stext-106 trans-04">
                                    Mặc định
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 'asc']) }}" class="filter-link stext-106 trans-04">
                                    Giá: Thấp đến cao
                                </a>
                            </li>

                            <li class="p-b-6">
                                <a href="{{ request()->fullUrlWithQuery(['price' => 'desc']) }}" class="filter-link stext-106 trans-04">
                                    Giá: Cao đến thấp
                                </a>
                            </li>
                        </ul>
                    </div>

                

                </div>
            </div>
        </div>

        <div id="loadProduct">
            @include('customer.products.list')
        </div>

        <div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
            
            {{ $products->links('pagination::bootstrap-4') }}
        </div>

    </div>
</div>
    
 @endsection 