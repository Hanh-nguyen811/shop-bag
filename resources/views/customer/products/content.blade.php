@extends('customer.main')
@section('content')
    <div class="container p-t-80">
        @include('admin.alert')
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/hang/{{ $products->brands->id }}/{{ \Str::slug($products->brands->name) }}.html"
               class="stext-109 cl8 hov-cl1 trans-04">
                {{ $products->brands->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{ $title }}
			</span>
        </div>
    </div>
    {{-- Product Detail --}}
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="/upload/product/{{$products->image}}">
									<div class="wrap-pic-w pos-relative">
										<img src="/upload/product/{{$products->image}}" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/upload/product/{{$products->image}}">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

                                @foreach ($img_pro as $img)
                                    <div class="item-slick3" data-thumb="/upload/product/{{$img->sub_photo}}">
                                        <div class="wrap-pic-w pos-relative">
                                                <img src="/upload/product/{{$img->sub_photo}}" alt="IMG-PRODUCT">

                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/upload/product/{{$img->sub_photo}}">
                                                    <i class="fa fa-expand"></i>
                                                </a>
                                                
                                        </div>
                                    </div>
                                @endforeach	
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $title }}
						</h4>

						<span class="mtext-106 cl2">
                            {{number_format($products->price)}}đ
						</span>

						<p class="stext-102 cl3 p-t-23">
                            {!! $products->description !!}							
						</p>
						
						<!--Add to cart   -->
						<div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <form action="/add-cart" method="post">
                                        @if ($products->price !== NULL)
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                       name="num_product" value="1">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>


                                            <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 ">
                                                Thêm vào giỏ hàng
                                            </button>
                                            <input type="hidden" name="id_product" value="{{ $products->id }}">
                                        @endif
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>

						
					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							{{-- <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Nội dung</a> --}}
						</li>
					</ul>

					<!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $products->content !!}
                                </p>
                            </div>
                        </div>
                        
                    </div>
				</div>
			</div>
		</div>

		<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
                Hãng: 
				<a href="/hang/{{ $products->brands->id }}/{{ \Str::slug($products->brands->name) }}.html">
					 {{ $products->brands->name }}
				</a>
			</span>
		</div>
	</section>

    {{-- Sản phẩm liên quan --}}
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Sản phẩm liên quan
				</h3>
			</div>
			<div class="wrap-slick2">
				<div class="slick2">
                    @foreach ($productMore as $product)

					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">
                                <img src="/upload/product/{{$product->image}}" alt="{{ $product->name }}" >
								
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="/san-pham/{{$product->id}}/{{\Str::slug($product->name)}}.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>

									<span class="stext-105 cl3">
                                        {{number_format($product->price)}}đ
									</span>
								</div>

							</div>
						</div>
					</div>

                    @endforeach
				</div>
			</div>
		</div>
	</section>

@endsection

