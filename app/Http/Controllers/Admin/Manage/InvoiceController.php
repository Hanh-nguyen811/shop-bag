<?php

namespace App\Http\Controllers\Admin\Manage;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Models\InvoiceDetail;
use App\Models\Invoices;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    // Danh sách các đơn hàng
    public function index()
    {
        $invoices = Invoices::with('shippings')->get();
        return view('admin.manage.invoice.list', [
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'invoices' => $invoices
        ]);

    }

    // Chi tiết đơn hàng
    public function list($id)
    {

		$shipping = Shipping::where('id',$id)->first();

        $invoices = Invoices::with('shippings')->where('id',$id)->get();

		$invoice_detail = InvoiceDetail::with('products')->where('id_invoice', $id)->get();
        return view('admin.manage.invoice.detail', [
            'title' => 'Chi Tiết Đơn Hàng : '. $shipping->name,
            'shipping' => $shipping,
            'invoices' => $invoices,
            'invoice_detail'=>$invoice_detail
        ]);

    }

    // Danh sách các đơn thành công
    public function new(){
        $invoices = Invoices::with('shippings')
        ->where('status','0')->get();
        return view('admin.manage.invoice.new', [
            'title' => 'Danh sách các đơn thành công',
            'invoices' => $invoices
        ]);
    }

    // Danh sách các đơn hủy
    public function cancel(){
        $invoices = Invoices::with('shippings')
        ->where('status','-1')->get();
        return view('admin.manage.invoice.cancel', [
            'title' => 'Danh Sách Đơn Hủy',
            'invoices' => $invoices
        ]);
    }

    // Danh sách các đơn thành công
    public function successful(){
        $invoices = Invoices::with('shippings')
        ->where('status','3')->get();
        return view('admin.manage.invoice.successful', [
            'title' => 'Danh sách các đơn thành công',
            'invoices' => $invoices
        ]);
    }

    // Cập nhật số lượng đã bán
    public function update_invoice_qty(Request $request){
        $data = $request->all();
		$invoices = Invoices::find($data['id']);
		$invoices->status = $data['status'];
		$invoices->save();

        // date
        $date = $invoices->date;
        $statistic = Statistic::where('date',$date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        if($invoices->status==2){
            $total_order = 0;
            $sales = 0;
            $quantity = 0;

			foreach($data['order_product_id'] as $key => $id){
				
				$product = Product::find($id);
				$pro_quantity = $product->pro_quantity;
				$product_sold = $product->product_sold;

                $pro_price = $product->price;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
				foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                            $pro_remain = $pro_quantity - $qty;
                            $product->pro_quantity = $pro_remain;
                            $product->product_sold = $product_sold + $qty;
                            $product->save();

                            // update doanh thu
                            $quantity += $qty;
                            $total_order +=1;
                            $sales += $pro_price * $qty;
                    }
                }
			}
        
            // Update doanh số vào database
            if($statistic_count>0){
                $statistic_update = Statistic::where('date',$date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
           
            }else{
                $statistic_new = new Statistic();
                $statistic_new->date = $date;
                $statistic_new->sales = $sales;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }

		}
        // elseif($invoices->status!=2 ){
		// 	foreach($data['order_product_id'] as $key => $id){
				
		// 		$product = Product::find($id);
		// 		$pro_quantity = $product->pro_quantity;
		// 		$product_sold = $product->product_sold;
		// 		foreach($data['quantity'] as $key2 => $qty){
		// 				if($key==$key2){
        //                     $pro_remain = $pro_quantity + $qty;
        //                     $product->pro_quantity = $pro_remain;
        //                     $product->product_sold = $product_sold - $qty;
        //                     $product->save();
		// 				}
		// 		}
		// 	}
		// }
    }
}
