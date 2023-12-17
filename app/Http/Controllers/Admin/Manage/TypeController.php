<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function list()
    {
        $types = Type::with('brands')->get();
        return view('admin.manage.type.list',
        ['title'=>'Danh sách loại sản phẩm','types'=>$types]
       );

    }

    // Thêm
    public function create(){
        $types =Type::all();
        $brands = Brand::all();
        return view('admin.manage.type.add',[
            'title'=>'Thêm loại sản phẩm',
            'types'=>$types,'brands'=>$brands
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên loại sản phẩm '
        ]);

        $types = new Type;
        $types->name = $request->name;
        $types->status = $request->status;
        $types->id_brand = $request->id_brand;
        $types->save();

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }
    
    // Sủa
    public function show($id){
        $types=Type::find($id);
        $brands = Brand::all();

        return view('admin.manage.type.edit',[
            'title'=>'Sửa loại sản phẩm',
            'types'=>$types,
            'brands'=>$brands
        ]);
    }
    public function update(Request $request, $id){
        $types = Type::find($id);
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên loại sản phẩm '
        ]);
        $types->name = $request->name;
        $types->status = $request->status;
        $types->id_brand = $request->id_brand;
        $types->save();

        return redirect('/admin/manage/types/list')->with('notification','Bạn đã cập nhật thành công');

    }
    
    public function delete($id)
    {

        Type::find($id)->delete();
        return redirect()->back()->with('notification','Bạn đã xóa thành công');
    }

}
