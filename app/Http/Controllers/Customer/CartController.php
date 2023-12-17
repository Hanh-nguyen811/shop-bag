<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\InvoiceDetail;
use App\Models\Invoices;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    function __construct()
    {
        $menus = Menu::where('status',1)->get();
        view()->share('menus',$menus);

    }
    // Tạo giỏ hàng
    public function index(Request $request)
    {
        $result = $this->create($request);
        
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function create($request){
        $quantity = $request->input('num_product');
        $id_product = $request->input('id_product');


        if ($quantity <= 0 || $id_product <= 0) {
            Session::flash('error', 'Số lượng sản phẩm không chính xác');
            return false;
        }
        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $id_product => $quantity
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $id_product);
        if ($exists) {
            $carts[$id_product] = $carts[$id_product] + $quantity;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$id_product] = $quantity;
        Session::put('carts', $carts);

        return true;
       
    }

    // Danh sách sản phẩm giỏ hàng
    public function show(){
        $products = $this->getProduct();
        return view('customer.carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
        
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'image')
            ->where('status', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    // Cập nhật giỏ hàng
    public function update(Request $request ){

        Session::put('carts',$request->input('num_product'));
        return redirect('/carts');
      
    }

    // Xóa giỏ hàng
    public function delete($id)
    {
        
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return redirect('/carts');

    }

    // Đăt hàng
    public function addCart(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'email'=>'required'
        ],
        [
            'name.required'=>'Vui lòng nhập tên ',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'address.required'=>'Vui lòng nhập địa chỉ',
            'email.required'=>'Vui lòng chọn email',
        ]);

        $carts = Session::get('carts');

        // Lưu thông tin vào shipping 
        $shippings = new Shipping;
        $shippings->name = $request->name;
        $shippings->phone = $request->phone;
        $shippings->email = $request->email;
        $shippings->address = $request->address;
        $shippings->note = $request->note;
        $shippings->save();
        
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'image')
        ->where('status', 1)
        ->whereIn('id', $productId)
        ->get();
 
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        
        // Lưu thông tin vào invoice
        $invoices = new Invoices;
        $invoices->id_shipping = $shippings->id;
        $invoices->id_customer = Auth::guard('customer')->id();
        $invoices->date= $now;
        $invoices->status='0';
        $invoices->save(); 

        // Lưu thông tin vào invoice detail
        foreach ($products as $product) {
            $invoices_detail = new InvoiceDetail;
            $invoices_detail->id_invoice =  $invoices->id;
            $invoices_detail->price = $product->price;
            $invoices_detail->id_product = $product->id;
            $invoices_detail->quantity   = $carts[$product->id];
            $invoices_detail->save(); 
        }
        
        Session::forget('carts');
        return redirect()->back()->with('notification','Bạn đã đặt hàng thành công. Cảm ơn bạn đã mua hàng của chúng tôi!');

    }


}


     
