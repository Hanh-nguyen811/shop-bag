<?php

namespace App\Http\Controllers\Admin\Manage;
use App\Http\Services\Menu\MenuService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    //Danh sách
    public function list()
    {
        $menus = Menu::get();
        return view('admin.manage.menu.list',[
            'title'=>'Danh sách danh mục',
            
        ],['menus'=>$menus]);
    } 



    // Thêm
    public function create()
    {
        $menus = Menu::where('parent_id',0)->get();
        return view('admin.manage.menu.add',[
            'title'=>'Thêm danh mục'
        ],['menus'=>$menus]);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],
        [
            'name.required'=>'Vui lòng nhập tên hãng'
        ]);

        $menus = new Menu;
        $menus->name = $request->name;
        $menus->parent_id = $request->parent_id;
        $menus->status = $request->status;
        $menus->save();

        return redirect()->back()->with('notification','Bạn đã thêm thành công');
    }


    // Sửa
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }
    
    public function show($id){
        $menus = Menu::find($id);
        return view('admin.manage.menu.edit',
        [
            'title'=>'Sửa danh mục' 
        ],[
        'menu' => $this->getParent(),
        'menus'=>$menus
    ]);
    }

    public function update(Request $request,$id){
        $menus = Menu::find($id);
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Vui lòng nhập tên danh mục'
        ]);

        $menus->name = $request->name;
        $menus->parent_id = $request->parent_id;
        $menus->status = $request->status;
        $menus->save();
        return redirect('/admin/manage/menus/list')->with('notification','Bạn đã cập nhật thành công');
    }

    public function delete($id){
        Menu::find($id)->delete();
        return redirect('/admin/manage/menus/list')->with('notification','Bạn xóa thành công');

    }

}
