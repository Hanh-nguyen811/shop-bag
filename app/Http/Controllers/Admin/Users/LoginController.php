<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',[
            'title'=> 'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required|'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'password.required'=>'Vui lòng nhập password'
        ]);

        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ], $request->input('remember'))){
            return redirect()->route('admin');
        }
        return redirect()->back()->with('error','Mật khẩu hoặc email không đúng');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
