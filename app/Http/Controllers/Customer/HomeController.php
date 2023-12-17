<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Invoices;
use App\Models\News;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Slider;
use App\Models\InvoiceDetail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
   
    function __construct()
    {

        $menus = Menu::where('status',1)->get();
        $sliders = Slider::where('status',1)->get();
        $news = News::where('status',1)->paginate(3);
        $products = Product::where('status',1)->paginate(16);


        view()->share('menus',$menus);
        view()->share('sliders',$sliders);
        view()->share('products',$products);
        view()->share('news',$news);


        
    }


    // Home Customer
    public function index()
    {
        return view('customer.home',[
            'title'=>'Shop PEDRO',
        ]);
    }
    // Register customer
    public function register(){
        return view('customer.users.register',[
            'title'=>'Đăng ký'
        ]);
    }

    // Create register
    public function create(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:customers,email',
            'password' => 'required',
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Vui lòng nhập password',
            'name.required'=>'Vui lòng nhập tên',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'address.required'=>'Vui lòng nhập địa chỉ',
        ]);

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->back()->with('notification','Bạn đã đăng ký thành công');
    }

    // Login customer
    public function login(){
        return view('customer.users.login',[
            'title'=>'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'password.required'=>'Vui lòng nhập password'
        ]);

        if(Auth::guard('customer')->attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ], $request->input('remember'))){
            return redirect()->route('home');

        }
        return redirect()->back()->with('error','Mật khẩu hoặc email không đúng');
    }

    // Logout customer
    public function logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }

    // Update
    public function show($id){
        $customer = Customer::find($id);
        return view('customer.users.edit_information',[
            'title'=>'Sửa thông tin cá nhân',
            'customer'=>$customer 
        ]);
        
    }

    public function update(Request $request,$id){
        $customer = Customer::find($id);

        $customer->fill($request->input());
        $customer->save();

        return redirect('/')->with('notification','Cập nhập thông tin thành công');
    }

    // Lịch sử mua hàng
    public function history($id){

        $invoices = Invoices::with('customers')->where('id_customer',$id)->get();
		$customer = Customer::where('id',$id)->first();

        return view('customer.users.invoice_history',[
            'title'=>'Lịch sử mua hàng',
            'customer'=>$customer,
            'invoices'=>$invoices
        ]);
    }

     // Chi tiết đơn hàng
     public function view($id){
        $invoices = Invoices::with('shippings')->where('id',$id)->get();
        $invoice_detail = InvoiceDetail::with('products')->where('id_invoice', $id)->get();
        return view('customer.users.invoice_detail',[
            'title'=>'Chi tiết đơn hàng',
            'invoice_detail'=>$invoice_detail,
            'invoices' => $invoices


        ]);
    }

    //Hủy đơn
    public function cancel($id){
        $invoices = Invoices::find($id);
        $invoices->status = -1;
        $invoices->save();
        return redirect()->back()->with('notification','Bạn đã hủy đơn thành công');

    }

    // Xác nhận đơn 
    public function confirm($id){
        $invoices = Invoices::find($id);
        $invoices->status = 3;
        $invoices->save();
        return redirect()->back()->with('notification','Bạn đã xác nhận thành công');

    }
    // List news
    public function list(){
        
        return view('customer.news.list',[
            'title'=>'Tin tức'
        ]);
    }

    // Đọc tin tức
    public function read($id){
        $news = News::find($id);
        return view('customer.news.content',[
            'title'=>'Nội dung',
            'news'=>$news
        ]);
    }

    // Search product
    public function search(Request $request){
       $key = $request->key;
       $products = Product::where('status',1)
       ->where('name','like',"%$key%")
       ->orWhere('price',$key)->where('status',1)
       ->paginate(16)->appends(['key' => $key]);//     giúp ta chuyển trang page sẽ đính kèm theo từ khóa search của sản phẩm
       return view('customer.search',[
        'title'=>'Tìm kiếm',
        'products'=>$products,
        'key'=>$key
       ]);
    }

    
}

