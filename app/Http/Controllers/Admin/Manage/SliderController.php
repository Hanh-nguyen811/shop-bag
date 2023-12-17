<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
class SliderController extends Controller
{
    //
    public function list()
    {
        $sliders =Slider::get();
        return view('admin.manage.slider.list',
        ['title'=>'Danh sách slider','sliders'=>$sliders],
       );

    }
    public function create()
    {
        $sliders = Slider::all();
        return view('admin.manage.slider.add',[
            'title'=>'Thêm slider','sliders'=>$sliders
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'url'=>'required',
            'sort_by'=>'required',
            'image'=>'required|mimes:jpg,bmp,png,jpeg,webp'
        ],
        [
            'name.required'=>'Vui lòng nhập tên tiêu đề',
            'url.required'=>'Vui lòng nhập đường dẫn',
            'sort_by.required'=>'Vui lòng nhập sắp xếp',
            'image.required'=>'Vui lòng chọn ảnh',
            'image.mimes'=>'Vui lòng chọn ảnh jpg,bmp,png,jpeg,webp'
        ]);

        $sliders = new Slider;
        $sliders->name = $request->name;
        $sliders->url = $request->url;
        $sliders->sort_by = $request->sort_by;
        $sliders->status = $request->status;
        

         // Image
         if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move("upload/slider",$name);
            $sliders->image = $name;
        }
        $sliders->save();

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }

    public function show($id)
    {
        
        $sliders= slider::find($id);
        
        return view('admin.manage.slider.edit',[
            'title'=>'Sửa slider','sliders'=>$sliders
        ]);
    }

    public function update(Request $request,$id)
    {
        $sliders =Slider::find($id);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move("upload/slider",$name);
            $sliders->image = $name;
        }
        
        $sliders->fill($request->input());
        $sliders->save();

        return redirect('/admin/manage/sliders/list')->with('notification','Bạn cập nhập thành công');
    }

    public function delete($id)
    {

        Slider::find($id)->delete();
        return redirect()->back()->with('notification','Bạn đã xóa thành công');
    }
}
