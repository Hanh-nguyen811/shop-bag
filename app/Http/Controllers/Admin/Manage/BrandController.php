<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //Danh sách
    public function list()
    {
        $brands = Brand::get();
        return view('admin.manage.brand.list',[
            'title'=>'Danh sách hãng sản phẩm'
        ],['brands'=>$brands]);
    } 

    // Thêm
    public function create()
    {
        $brands = Brand::all();
        
        return view('admin.manage.brand.add',[
            'title'=>'Thêm hãng sản phẩm'
        ],['brands'=>$brands]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],
        [
            'name.required'=>'Vui lòng nhập tên hãng'
        ]);

        $brands = new Brand;
        $brands->name = $request->name;
        $brands->status = $request->status;
        $brands->save();

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }

    // Sửa
    public function show($id){
        $brands = Brand::find($id);
        return view('admin.manage.brand.edit',[
            'title'=>'Sửa hãng'
        ],['brands'=>$brands]);
    }

    public function update(Request $request,$id){
        $brands = Brand::find($id);
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên hãng'
        ]);

        $brands->name = $request->name;
        $brands->status = $request->status;
        $brands->save();
        return redirect('/admin/manage/brands/list')->with('notification','Bạn cập nhật thành công');
    }

    public function delete($id){
        Brand::find($id)->delete();
        return redirect()->back()->with('notification','Bạn xóa thành công');

    }

}
