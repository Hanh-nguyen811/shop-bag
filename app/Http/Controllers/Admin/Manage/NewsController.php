<?php

Namespace App\Http\Controllers\Admin\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;



class NewsController extends Controller
{
    public function list()
    {
        $news = News::get();
        return view('admin.manage.new.list',
        ['title'=>'Danh sách tin tức','news'=>$news],
       );

    }
    public function create()
    {
        $news = News::all();
        return view('admin.manage.new.add',[
            'title'=>'Thêm tin tức','news'=>$news
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'image'=>'required|mimes:jpg,bmp,png,jpeg'
        ],
        [
            'title.required'=>'Vui lòng nhập tên danh mục',
            'description.required'=>'Vui lòng nhập tóm tắt',
            'content.required'=>'Vui lòng nhập nội dung',
            'image.required'=>'Vui lòng chọn ảnh',
            'image.mimes'=>'Vui lòng chọn ảnh jpg,bmp,png,jpeg'
        ]);

        $news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->content = $request->content;
        $news->status = $request->status;

        

         // Image
         if($request->hasFile('image')){
            $file = $request->file('image');
            $title = $file->getClientOriginalName();
            $file->move("upload/new",$title);
            $news->image = $title;
        }
        $news->save();

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }

    public function show($id)
    {
        
        $news= News::find($id);
        
        return view('admin.manage.new.edit',[
            'title'=>'Sửa tin tức','news'=>$news
        ]);
    }

    public function update(Request $request,$id)
    {
        $news =News::find($id);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $title = $file->getClientOriginalName();
            $file->move("upload/new",$title);
            $news->image = $title;
        }
        
        $news->fill($request->input());
        $news->save();

        return redirect('/admin/manage/news/list')->with('notification','Bạn cập nhập thành công');
    }

    public function delete($id)
    {

        News::find($id)->delete();
        return redirect()->back()->with('notification','Bạn đã xóa thành công');
    }
}
