<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBillingDetail;
use App\Models\Product;
use App\Models\TransactionPayments;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function create(){
        $customers = Customer::all();
        $products = Product::all();
        
        return view('sale.create')->with(compact('customers' , 'products'));
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $start_date = Carbon::now('GMT+5');
            if($request->payment_cycle == 'annually'){
                $billing_cycle_renew = 365;
            }else{
                $billing_cycle_renew = 30;
            }
            $due_amount = $request->price - $request->advance_payment;
            $data = [
                'customer_id'=> $request->customer_id , 
                'product_id' => $request->product_id, 
                'advance_payment' =>$request->advance_payment,
                'total_amount'=> $request->price , 
                'billing_cycle_renew' => $billing_cycle_renew,
                'start_date' => $start_date,
                'due_amount' => $due_amount
            ];    
            $customer_billing_details = CustomerBillingDetail::create( $data );
            if($request->advance_payment != 0){
                $payment_data = [
                    'payment_method' => $request->payment_method,
                    'transaction_id' => $customer_billing_details->id,
                    'amount' => $request->advance_payment,
                    'created_by' => Auth::user()->id,
                    'method' => $request->payment_method
                ];
                TransactionPayments::create($payment_data);
            }
            DB::commit();
            return redirect('/');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
        
    }
}
