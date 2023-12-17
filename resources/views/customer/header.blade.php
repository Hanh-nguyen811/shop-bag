
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop" style="background-color: #fff;top : 0">
            <nav class="limiter-menu-desktop container">

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="/"><i class="fa fa-home" aria-hidden="true" style="font-size: 30px"></i></a>
                        </li>
                        @foreach ($menus as $menu)
                        @if ($menu->parent_id == 0)
                            
                            <li class="active-menu">
                                <a href="#">{{$menu->name}}</a>
                                
                                <ul class="sub-menu">
                                    @foreach ($menu->menuChildrent as $menuChildrent)
                                    <li><a href="/danh-muc/{{$menuChildrent->id}}/{{\Str::slug($menuChildrent->name)}}.html">
                                            {{$menuChildrent->name}}                           
                                        </a></li>                      
                                    @endforeach
                                </ul>
                            </li>
                        
                        @endif
                    @endforeach
                        <li class="active-menu"><a href="/tin-tuc">Tin tức</a></li>
                        <li class="active-menu"><a href="#contact">Liên hệ</a></li>
                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <form action="search" method="get">
                        @csrf
                        <div class="bor17 of-hidden pos-relative">
                            <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="key" placeholder="Tìm kiếm">

                            <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" 
                    data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                    
                    <a href="/carts">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                    </div>
                    @if (Auth::guard('customer')->check())
                    <ul class="main-menu">
                        <li class="active-menu">
                                {{Auth::guard('customer')->user()->name}}                    
                            <ul class="sub-menu">
                                <li><a href="/dang-xuat">Đăng xuất</a></li>
                                <li><a href="/lich-su/{{Auth::guard('customer')->id()}}">Lịch sử</a></li>
                                <li><a href="/sua-thong-tin/{{Auth::guard('customer')->id()}}">Sửa thông tin cá nhân</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                    @else

                        <a href="/dang-ky" class="flex-c-m trans-04 p-lr-25" style="color: #ca61ff">
                            Đăng ký
                        </a>
                        |
                        <a href="/dang-nhap" class="flex-c-m trans-04 p-lr-25" style="color: #ca61ff">
                            Đăng nhập
                        </a> 
                    @endif
                    
                </div>
            </nav>
        </div>	
    </div>
