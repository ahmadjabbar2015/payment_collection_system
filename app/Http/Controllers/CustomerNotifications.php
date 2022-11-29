<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\TransactionPayments;
use DateTime;


class CustomerNotifications extends Controller
{
    public function massSMS(){
        $customers = Customer::join('customer_billing_details as cbd', 'cbd.customer_id', '=', 'customers.id')
            ->join('products as p', 'p.id', '=', 'cbd.product_id')
            ->select(
                'cbd.total_amount',
                'customers.first_name',
                'p.name',
                'cbd.id as transaction_id',
                'cbd.start_date'
            )->get();
        // dd($customers);
        $data = [
            'payment_till_date' => 0
        ];
        foreach($customers as $customer){
            $payments = TransactionPayments::join('customer_billing_details as cbd', 'cbd.id' , '=', 'transaction_payments.transaction_id')
                ->where('transaction_id' , $customer->transaction_id)
                ->select(
                    'transaction_payments.amount as amount' , 
                    'transaction_payments.created_at as created_at', 
                    'transaction_payments.method as method',
                    'cbd.id as trans_id'
                )->get();

            foreach($payments as $payment){
                $data['payment_till_date'] += $payment->amount;
            }
            
            $d1 = date('Y-m-d', strtotime($customer->start_date));
            $d2 = date('Y-m-d');

            $d1 = new DateTime($d1); $d2 = new DateTime($d2);

            $interval = $d2->diff($d1);
            $interval->m = ($interval->m + (12 * $interval->y));
            $months = $interval->format('%m');
   
            $per_month_amount = $customer->total_amount/12;
            $amount_paid_for_no_of_months =(int) ($data['payment_till_date']/$per_month_amount);

            $amount_to_be_received_till_to_date = (int) $per_month_amount * $months;
            $customer_due_amount_till_date = $amount_to_be_received_till_to_date - $data['payment_till_date'];

            if($amount_to_be_received_till_to_date > $data['payment_till_date']){
                $msg = "Dear " . $customer->first_name . 
                         " \n You have outstanding Dues of Rs. " . $customer_due_amount_till_date;
                        //  dd($msg);
                $this->sendSMS($customer->mobile , null, $msg);
            }

        }
    }

    public function sendSMS( $to, $from, $msg ){
        $url = "https://lifetimesms.com/plain";

        $parameters = [
            "api_token" => "0d32b03c2ad9635e511c77d95d5a599d7f1b2b5756",
            "api_secret" => "cross-devlogix",
            "to" => $to,
            "from" => "CrossDev",
            "message" => $msg,
        ];

        $ch = curl_init();
        $timeout  =  30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $response = curl_exec($ch);
        curl_close($ch);

        echo $response ;
    }
}
