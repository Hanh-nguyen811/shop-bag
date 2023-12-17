<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Type;

class MenuController extends Controller
{
    
    function __construct()
    {
        $menus = Menu::where('status',1)->get();
        view()->share('menus',$menus);

    }

    // Hiện các sản phẩm trong menu
    function menu($id, Request $request)
    {
        $menus = Menu::find($id);
        $products = Product::where('id_menu',$id)->where('status',1)->paginate(16);

        if($request->input('price') == 'asc'){
            $products = Product::where('id_menu',$id)
            ->orderBy('price','ASC')
            ->where('status',1)->paginate(16)->withQueryString();
        }else{
            $products = Product::where('id_menu',$id)
            ->orderBy('price','DESC')
            ->where('status',1)->paginate(16)->withQueryString();
        }
        
        return view('customer.menu',[
            'title' => $menus-> name,
            'products'=>$products

        ]);
    }


    // Nội dung sản phẩm
    function show($id)

    {

        $products = Product::where('id',$id)
        ->where('status',1)
        ->with('brands')->firstOrFail();

        $img_pro = Image::where('product_id',$id)->get();

        $productMore = Product::where('status',1)
        ->with('brands')
        ->where('id','!=' ,$id)
        ->orderByDesc('id')
        ->get();

        return view('customer.products.content',[
            'title'=> $products -> name,
            'products'=>$products,
            'img_pro'=>$img_pro,
            'productMore'=>$productMore

            
        ]); 
    }


    //  Hiện các sản phẩm trong hãng
    function brand($id)
    {
        $brands = Brand::find($id);
        $products = Product::where('id_brand',$id)->where('status',1)->paginate(16);
        return view('customer.menu',[
            'title' => $brands-> name,
            'products'=>$products
        ]);
    }
    
}
