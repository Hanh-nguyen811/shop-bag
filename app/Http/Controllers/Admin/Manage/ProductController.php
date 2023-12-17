<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Product;
use App\Models\Image;
use App\Http\Controllers\Admin\Manage\DB;
use App\Models\Attribute;
use App\Models\ProductAttr;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    // Danh sách
    public function list()
    {
        $products = Product::with('brands','types')->get();
        return view('admin.manage.product.list',
        ['title'=>'Danh sách sản phẩm',
        'products'=>$products
        ]);

    }
    //Thêm
    public function create()
    {
        $menus = Menu::all();
        $products= Product::all();
        $types = Type::all();
        $brands = Brand::all();
        return view('admin.manage.product.add',[
            'title'=>'Thêm sản phẩm',
            'products'=>$products,
            'types'=>$types,
            'brands'=>$brands,
            'menus'=>$menus
        ]);
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'content'=>'required',
            'image' => 'image|mimes:jpg,png,jpeg,img',
            
        ],
        [
            'name.required'=>'Vui lòng nhập tên sản phẩm',
            'price.required'=>'Vui lòng nhập giá sản phẩm',
            'description.required'=>'Vui lòng nhập tóm tắt',
            'content.required'=>'Vui lòng nhập nội dung',
            'image.required'=>'Vui lòng thêm ảnh sản phẩm',
            'image.mimes'=>'Bạn chỉ được chọn đuôi jpg,png,jpeg,img'
            
        ]);

        $products= new Product;
        $products->name = $request->name;
        $products->id_brand = $request->id_brand;
        $products->id_type = $request->id_type;
        $products->description = $request->description;
        $products->content = $request->content;
        $products->status = $request->status;
        $products->price = $request->price;
        $products->pro_quantity = $request->pro_quantity;
        $products->id_menu = $request->id_menu;

        // Image
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move("upload/product",$name);
            $products->image = $name;
        }

        $products->save();

        // Product Image
        $image = $request->file('imageList');
            foreach($image as $value){
                $name = $value->getClientOriginalName();
                $value->move("upload/product",$name);
                Image::create([
                    'product_id'=>$products->id,
                    'sub_photo'=>$name
                ]);
            }

        

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }

    // Sửa
    public function show($id)
    {
        $products= Product::find($id);
        $menus = Menu::all();
        $types = Type::all();
        $brands = Brand::all();

        $img_pro = Image::where('product_id',$id)->get();

        return view('admin.manage.product.edit',[
            'title'=>'Sửa sản phẩm',
            'products'=>$products,
            'types'=>$types,
            'brands'=>$brands,
            'menus'=>$menus,
            'img_pro'=>$img_pro

           
        ]);
        
    }

    public function update(Request $request,$id)
    {
        $products =Product::find($id);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move("upload/product",$name);
            $products->image = $name;
        }
        
        $products->fill($request->input());


        // Product Image

        $image = $request->file('imageList');
        Image::where('product_id',$id)->delete();
        foreach($image as $value){
            $name = $value->getClientOriginalName();
            $value->move("upload/product",$name);
            Image::create([
                'product_id'=>$products->id,
                'sub_photo'=>$name
            ]);
        }
        $products->save();

        return redirect('/admin/manage/products/list')->with('notification','Bạn cập nhập thành công');
    }


    public function delete($id)
    {

        Product::find($id)->delete();
        Image::where('product_id',$id)->delete();
        return redirect()->back()->with('notification','Bạn đã xóa thành công');
    }

}
