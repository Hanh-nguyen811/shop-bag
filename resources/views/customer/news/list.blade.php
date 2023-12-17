@extends('customer.main')
@section('content')
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                @foreach ($news as $new)
                <div class="p-r-45 p-r-0-lg p-t-80">
                    
                    <!-- item blog -->
                    <div class="p-b-63">
                        <a href="tin-tuc/{{$new->id}}" class="hov-img0 how-pos5-parent"  >
                            <img src="/upload/new/{{$new->image}}" height="500px" >   
                        </a>

                        <div class="p-t-32">
                            <h4 class="p-b-15">
                                <a href="tin-tuc/{{$new->id}}" class="ltext-108 cl2 hov-cl1 trans-04">
                                    {{$new->title}}
                                    
                                </a>
                            </h4>

                            <p class="stext-117 cl6">
                                {!!$new->description!!}
                                
                            </p>
                            <div class="flex-w flex-sb-m p-t-18">
                                <a href="tin-tuc/{{$new->id}}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                    Đọc tiếp
                                    <i class="fa fa-long-arrow-right m-l-9"></i>
                                </a>
                            </div>
                            
                        </div>
                    </div>

                    
                    
                    
                </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
                        
                {{ $news->links('pagination::bootstrap-4') }}
                    
            </div>

            
        </div>
    </div>
</section>
@endsection


