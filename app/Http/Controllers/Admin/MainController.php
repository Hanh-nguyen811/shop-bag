<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class MainController extends Controller
{
    public function index(){
        $invoice = Invoices::all()->count();
        $invoice_complete = Invoices::where('status','3')->count();
        $invoice_cancel = Invoices::where('status','-1')->count();
        $invoice_new = Invoices::where('status','0')->count();
        return view('admin.home',[
            'title'=>'Thống kê doanh số',
            'invoice'=>$invoice,
            'invoice_complete'=>$invoice_complete,
            'invoice_cancel'=>$invoice_cancel,
            'invoice_new'=>$invoice_new
        ]);
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('date',[$from_date,$to_date])->orderBy('date','ASC')->get();

        foreach($get as $val){
            $chart_data[]= array(
                'period'=>$val->date,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
                'order'=>$val->total_order
            );
        }
        echo $data = json_encode($chart_data);


    
    }


    public function dashboard_filter(Request $request){
        $data = $request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString(); 
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString(); 
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString(); 

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('date',[$sub7days,$now])->orderBy('date','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('date',[$dauthangtruoc,$cuoithangtruoc])->orderBy('date','ASC')->get();
        }elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('date',[$dauthangnay,$now])->orderBy('date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('date',[$sub365days,$now])->orderBy('date','ASC')->get();

        }

        foreach($get as $val){
            $chart_data[]= array(
                'period'=>$val->date,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
                'order'=>$val->total_order
            );
        }

        echo $data = json_encode($chart_data);
        
        
    }

    public function days_order(){
        $sub30days  = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('date',[$sub30days,$now])->orderBy('date','ASC')->get();

        foreach($get as $val){
            $chart_data[]= array(
                'period'=>$val->date,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
                'order'=>$val->total_order
            );
        }

        echo $data = json_encode($chart_data);
    }

  
}
