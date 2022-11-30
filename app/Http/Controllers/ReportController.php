<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\TransactionPayments;
use DateTime;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function all(Request $request){
            $arr = [];
            
                $due_amount = 0;
        
            
            $customers = Customer::join('customer_billing_details as cbd', 'cbd.customer_id', '=', 'customers.id')
                ->join('products as p', 'p.id', '=', 'cbd.product_id')
                // ->join('transaction_payments as tp', 'cbd.id' , '=', 'tp.transaction_id')
                ->select(
                    'cbd.total_amount',
                    'customers.first_name',
                    'p.name',
                    'cbd.id as transaction_id',
                    'cbd.start_date',
                    'cbd.billing_cycle_renew'
                    // DB::raw('SUM(tp.amount) as amount_paid')
                )->orderBy('cbd.id' , 'asc')->get();
            $data = [
                'payment_till_date' => 0
            ];
            
            foreach($customers as $customer){
                $payments = TransactionPayments::join('customer_billing_details as cbd', 'cbd.id' , '=', 'transaction_payments.transaction_id')
                    ->where('transaction_id' , $customer->transaction_id)
                    ->select(
                        // 'transaction_payments.amount as amount' , 
                        'transaction_payments.created_at as created_at', 
                        'transaction_payments.method as method',
                        'cbd.id as trans_id',
                        DB::raw('SUM(transaction_payments.amount) as amount_paid')
                    )->first();
                    
                // foreach($payments as $payment){
                    $data['payment_till_date'] = $payments->amount_paid    ;
                // }
                    
                
                $d1 = date('Y-m-d', strtotime($customer->start_date));
                $d2 = date('Y-m-d');
    
                $d1 = new DateTime($d1); 
                $d2 = new DateTime($d2);
    
                $interval = $d2->diff($d1);
                $interval->m = ($interval->m + (12 * $interval->y));
                $months = $interval->format('%m');

                if($customer->billing_cycle_renew == 30){
                    $per_month_amount = $customer->total_amount; 
                }else{
                    $per_month_amount = $customer->total_amount/12;
                }
       
                
                $amount_paid_for_no_of_months =(int) ($data['payment_till_date']/$per_month_amount);
                $amount_to_be_received_till_to_date = (int) $per_month_amount * $months;
                $customer_due_amount_till_date = $amount_to_be_received_till_to_date - $data['payment_till_date'];
                
                if($amount_to_be_received_till_to_date > $data['payment_till_date']){
                    if($amount_to_be_received_till_to_date > $due_amount){
                        $arr[] = 
                        [
                            'customer_name' => $customer->first_name,
                            'payment_due' => $customer_due_amount_till_date
                        ];
                    }
                }
                
            }

            if(request()->ajax()){
                $html = ''; 
                if(request()->has('due_amount')){
                    $due_amount =(int) request()->due_amount;
                }
                foreach($arr as $c){
                    if($c['payment_due'] > $due_amount){
                        $html .= '<tr><td>' . $c['customer_name'] . '</td><td>' . $c['payment_due'] . '</td></tr>';
                    }
                }
                return $html;
            }

            return view('reports.customer_reports')->with(compact('arr'));
        }
}

