<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerBillingDetail;
use App\Models\TransactionPayments;
use Exception;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use DateTime;

class CustomerController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $customers = Customer::get();
            // dd($customers);
          return  Datatables::of($customers)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
              $actionBtn =
              '<a href="/customer/show/' . $row->id . '" class="edit btn btn-success btn-sm"><i class="ni ni-app"></i></a>
              <a href="/propertytype/edit/' . $row->id . '" class="edit btn btn-success btn-sm"><i class="ni ni-app"></i></a>
              <a href="/propertytype/delete/' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="ni ni-fat-delete"></i></a>';
              return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
        //   ->toJson();
            // return Datatables::of($customers)->addIndexColumn();
        }
        

        return view('customer.index');
    }
    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request){
        $validator = $request->validate([
            'first_name' => 'required|max:255',
            'last_name'=> 'required|max:255',
            'mobile_no' => 'required|max:255',
        ]);


        try{
        DB::beginTransaction();
        if($validator){
            $data = $request->except('_token' );
            Customer::create($data);
        }
        DB::commit();
        return redirect(route('customer.index')); 
        }catch(Exception $e){
        DB::rollBack();
        dd($e);
        }
    }

    public function show($id){
        $customer = Customer::where('id', '=', $id)->first();
        
        $data = CustomerBillingDetail::join('customers' ,  'customers.id', '=', 'customer_billing_details.customer_id')
            ->join('products', 'products.id' , '=' , 'customer_billing_details.product_id')
            ->join('transaction_payments as tp', 'tp.transaction_id' , '=' , 'customer_billing_details.id' )
            ->select('customer_billing_details.*' , 
                    'customers.first_name',
                    'products.name as product',
                     DB::raw('SUM(tp.amount) as amount_paid')
            )->where('customers.id' , '=', $id)
            ->groupBy('customer_billing_details.id')
            ->get();
        
        if(request()->ajax()){
            
          return  Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('next_payment', function($row){           
            $next_payment_cycle = $row->billing_cycle_renew;
            $amount = $row->total_amount;
            if($next_payment_cycle == 30){
                $amount_paid_for_no_of_months =ceil($row->amount_paid / $amount);
                return $next_payment = ($amount * ($amount_paid_for_no_of_months +1)) - $row->amount_paid;
            }
            if($next_payment_cycle == 0){
                return $amount - $row->amount_paid;
            }
          })
          ->addColumn('next_payment_date', function($row){           
            $next_payment_cycle = $row->billing_cycle_renew;
            if($next_payment_cycle == 30){
                $amount = $row->total_amount;
                $amount_paid_for_no_of_months =ceil ($row->amount_paid / $amount);
                return $next_payment_date = date("d-M-Y", strtotime(date("Y-m-d", strtotime($row->start_date)) . " +".$amount_paid_for_no_of_months." month") ); 
            }
          })
          ->addColumn('payment_due_till_date', function($row){           
            $next_payment_cycle = $row->billing_cycle_renew;
            $amount = $row->total_amount;
            $amount_paid_till_date = $row->amount_paid;

            if($next_payment_cycle == 30){
                $amount = $row->total_amount;
                $d1 = date('Y-m-d', strtotime($row->start_date));
                $d2 = date('Y-m-d');
                $d1 = new DateTime($d1); 
                $d2 = new DateTime($d2);
                
                $interval = $d2->diff($d1);
                $interval->m = ($interval->m + (12 * $interval->y));
                $months =(int) $interval->format('%m');  
                $total_amount_till_date = $amount * $months;

                if($total_amount_till_date > $amount_paid_till_date){
                    return ($total_amount_till_date - $amount_paid_till_date);
                }else{
                    return 0;
                }
            }else{
                if($amount > $amount_paid_till_date){
                    return $amount - $amount_paid_till_date;
                }else{
                    return 0;
                }
            }
          })
          ->addColumn('action', function ($row) {
              $actionBtn =
              '<div class="dropdown">
              <a href="/customer/customer-payments/'.$row->id.'" class="btn btn-secondary dropdown-toggle payment-btn">
                View
              </a>
            </div>';
              return $actionBtn;
          })
          ->rawColumns(['action', 'next_payment_date','payment_due_till_date'])
          ->make(true);
        //   ->toJson();
            // return Datatables::of($customers)->addIndexColumn();
        }

        return view('customer.show')->with(compact('customer'));
    }

    public function customerPayments($id){
        $cbd = CustomerBillingDetail::where('id' , $id)->first();
        if(!$cbd){
            return redirect()->back();
        }
        $next_payment_cycle = $cbd->billing_cycle_renew;
        $total_amount_paid = 0;
        $html = '';
        $html_start = 
        '<div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Method</th>
                <th scope="col">Trans. Date</th>
              </tr>
            </thead>
            <tbody>';
        $table = '';
            
        $table_end = '</tbody> </table>';
        $model_footer = '<div class="modal-footer"> <a href="'.route('customer.add-customer-payments' , $id).'" class="btn btn-primary add-payment-btn">Add Payment</a> </div>';
        $html_end = '</div> '.$model_footer.'</div> </div>';


        $data = TransactionPayments::join('customer_billing_details as cbd', 'cbd.id' , '=', 'transaction_payments.transaction_id')
        ->where('transaction_id' , $id)
        ->select(
            'transaction_payments.amount as amount' , 
            'transaction_payments.created_at as created_at', 
            'transaction_payments.method as method', 
        )->get();
        
        $payment_data = [];
        foreach($data as $d){
            $payment_date = date('d-M-Y', strtotime($d->created_at)) ;
            $payment_data[] = [
                'amount' => $d->amount,
                'method' => $d->method,
                'transaction_date' => $payment_date
            ];
            $total_amount_paid += $d->amount;
        }
        $i = 0;
        if(empty($payment_data)){
            $table = '<tr> <td colspan="4" class="text-info text-center">No Record Found</td> </tr>';
        }
        foreach($payment_data as $p_data){
            $table .= ' <tr>
            <th scope="row">'. ++$i .'</th>
            <td>'.$p_data['amount'].'</td>
            <td>'.$p_data['method'].'</td>
            <td>'.$p_data['transaction_date'].'</td>
          </tr> ' ;
        }
        if($next_payment_cycle == 30){
        
            $amount = $cbd->total_amount;
            
            $amount_paid_for_no_of_months =ceil($total_amount_paid / $amount);
            $next_payment = ($amount * ($amount_paid_for_no_of_months +1)) - $total_amount_paid;
            $next_payment_date = date("d-M-Y", strtotime(date("Y-m-d", strtotime($cbd->start_date)) . " +".$amount_paid_for_no_of_months." month") );
            $next_payment_html = '<div> <span>Next Due Date</span> <span>'.$next_payment_date.'</span></div>
            <div> <span>Next Payment Amount</span> <span>'.$next_payment.'</span></div>
            ';
            $html .= '' . $html_start . $table . $table_end . $next_payment_html . $html_end ;
            
            return $html;
        }
        else{
            $html .= '' . $html_start . $table . $table_end . $html_end ;
            return $html;   
        }
        
    
        
        
        
    }
     public function addCustomerPayments(Request $request){
        $id = $request->id;
        $cbd = CustomerBillingDetail::where('id' , $id)->first();
        $html_start = 
        '<div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">';
            $url = route('customer.add-customer-payments-store');
            
            $form = '
            <form id="add-payment-form" method="POST" action="'.$url.'">

            <input type="hidden" required name="cbd_id" value="'.$cbd->id.'">
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" required class="form-control"  name="amount" placeholder="000.0">
          </div>
          <div class="form-group">
            <label for="date">Date</label>
            <input type="date" required class="form-control" name="date">
          </div>
          <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select type="number" required class="form-control" required="required" placeholder="0" name="payment_method" id="billing_cycle" >
                <option disabled>Please Select An Option</option>
                <option selected value="cash">Cash</option>
                <option value="card">Card</option>
            </select>
          </div>

          <div class="form-group">
          <button type="submit" class="btn btn-primary">Submit</button> 
          </div>
          </form>
          ';
        
        
        $html_end = '</div> </div> </div>';

        $html = $html_start . $form . $html_end ;
        return $html;


     }

    public function addCustomerPaymentStore(Request $request){
        
        try {
            
            $id = $request->cbd_id;
            $amount = $request->amount;
            $method = $request->payment_method;
            $date = $request->date;
            $user_id = Auth::user()->id;
            $cbd = CustomerBillingDetail::where('id' , $id)->first();
            // if($cbd->due_amount < $amount){
            //     return "Something Went Wrong";
            // }

            TransactionPayments::create([
                'transaction_id' => $cbd->id,
                'amount' => $amount,
                'method' => $method,
                'created_by' => $user_id,
                'created_at' => $date
            ]);

            $due_amount = $cbd->due_amount;
            $new_due_amount = $due_amount - $amount;
            $cbd->due_amount = $new_due_amount;
            $cbd->save();
            return ['status' => 1];

        } catch (\Throwable $th) {
            dd($th) ;
        }
        


    }

}
