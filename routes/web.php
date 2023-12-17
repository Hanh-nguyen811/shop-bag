<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\Manage\BrandController;
use App\Http\Controllers\Admin\Manage\InvoiceController;
use App\Http\Controllers\Admin\Manage\MenuController;
use App\Http\Controllers\Admin\Manage\NewsController;
use App\Http\Controllers\Admin\Manage\ProductController;
use App\Http\Controllers\Admin\Manage\SliderController;
use App\Http\Controllers\Admin\Manage\TypeController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\PaymentController;
use App\Models\Invoices;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Admin
// Đăng nhập, đăng xuất
Route::get('admin/users/login',[LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store']);
Route::get('logout',[LoginController::class,'logout']);

// Trang chủ Admin
Route::middleware(['auth'])->group(function(){
    // Thống kê 
    Route::prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);
        Route::post('filter-by-date',[MainController::class,'filter_by_date']);
        Route::post('dashboard-filter',[MainController::class,'dashboard_filter']);
        Route::post('days-order',[MainController::class,'days_order']);

        

        Route::prefix('manage')->group(function(){
            // Danh mục
            Route::prefix('menus')->group(function(){
                Route::get('list',[MenuController::class,'list']);
                Route::get('add',[MenuController::class,'create']);
                Route::post('add',[MenuController::class,'store']);
                Route::get('edit/{id}',[MenuController::class,'show']);
                Route::post('edit/{id}',[MenuController::class,'update']);
                Route::get('delete/{id}',[MenuController::class,'delete']);

            });

            // Hãng
            Route::prefix('brands')->group(function(){
                Route::get('list',[BrandController::class,'list']);
                Route::get('add',[BrandController::class,'create']);
                Route::post('add',[BrandController::class,'store']);
                Route::get('edit/{id}',[BrandController::class,'show']);
                Route::post('edit/{id}',[BrandController::class,'update']);
                Route::get('delete/{id}',[BrandController::class,'delete']);

            });

                // Loại
            Route::prefix('types')->group(function(){
                Route::get('list',[TypeController::class,'list']);
                Route::get('add',[TypeController::class,'create']);
                Route::post('add',[TypeController::class,'store']);
                Route::get('edit/{id}',[TypeController::class,'show']);
                Route::post('edit/{id}',[TypeController::class,'update']);
                Route::get('delete/{id}',[TypeController::class,'delete']);

            });

            // Slider
            Route::prefix('sliders')->group(function(){
                Route::get('list',[SliderController::class,'list']);
                Route::get('add',[SliderController::class,'create']);
                Route::post('add',[SliderController::class,'store']);
                Route::get('edit/{id}',[SliderController::class,'show']);
                Route::post('edit/{id}',[SliderController::class,'update']);
                Route::get('delete/{id}',[SliderController::class,'delete']);

            });

            // Tin tức
            Route::prefix('news')->group(function(){
                Route::get('list',[NewsController::class,'list']);
                Route::get('add',[NewsController::class,'create']);
                Route::post('add',[NewsController::class,'store']);
                Route::get('edit/{id}',[NewsController::class,'show']);
                Route::post('edit/{id}',[NewsController::class,'update']);
                Route::get('delete/{id}',[NewsController::class,'delete']);
                
            });

            //Sản phẩm
            Route::prefix('products')->group(function(){
                Route::get('list',[ProductController::class,'list']);
                Route::get('add',[ProductController::class,'create']);
                Route::post('add',[ProductController::class,'store']);
                Route::get('edit/{id}',[ProductController::class,'show']);
                Route::post('edit/{id}',[ProductController::class,'update']);
                Route::get('delete/{id}',[ProductController::class,'delete']);
    
            });

              #Hóa đơn
            Route::get('customers', [InvoiceController::class, 'index']);
            Route::get('customers/view/{shipping}', [InvoiceController::class, 'list']);
            Route::get('customers/new', [InvoiceController::class, 'new']);
            Route::get('customers/cancel', [InvoiceController::class, 'cancel']);
            Route::get('customers/successful', [InvoiceController::class, 'successful']);
            Route::post('update-invoice-qty',[InvoiceController::class,'update_invoice_qty']);

        });

        // Ajax
        Route::prefix('ajax')->group(function(){
            Route::get('type/{id}',[AjaxController::class,'getAjax']);
        });
    });

});

// Customer
Route::get('dang-ky',[HomeController::class,'register']);
Route::post('dang-ky',[HomeController::class,'create']);
Route::get('dang-nhap',[HomeController::class,'login']);
Route::post('dang-nhap',[HomeController::class,'store']);
Route::get('dang-xuat',[HomeController::class,'logout']);
Route::get('sua-thong-tin/{id}',[HomeController::class,'show']);
Route::post('sua-thong-tin/{id}',[HomeController::class,'update']);
Route::get('lich-su/{id}',[HomeController::class,'history']);
Route::get('huy-don/{id}',[HomeController::class,'cancel']);
Route::get('xac-nhan/{id}',[HomeController::class,'confirm']);
Route::get('don-hang/{id}',[HomeController::class,'view']);

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('danh-muc/{id}/{slug}.html',[CustomerMenuController::class,'menu']);
Route::get('hang/{id}/{slug}.html',[CustomerMenuController::class,'brand']);
Route::get('san-pham/{id}/{slug}.html',[CustomerMenuController::class,'show']);
// Giỏ hàng
Route::post('add-cart',[CartController::class,'index']);
Route::get('carts', [CartController::class, 'show']);
Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'delete']);
Route::post('carts', [CartController::class, 'addCart']);
// Tin tức
Route::get('tin-tuc',[HomeController::class,'list']);
Route::get('tin-tuc/{id}',[HomeController::class,'read']);

// Tìm kiếm
Route::get('search',[HomeController::class,'search']);