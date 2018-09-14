<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(){
        $payments = DB::table('payments')
            ->join('orders', 'orders.id', '=', 'payments.order_id')
            ->select(['payments.id', 'orders.id as order_id', 'orders.enquiry_id as enquiry_id', 'orders.quotation_id as quotation_id','payments.amount' ,'payments.created_at', 'payments.updated_at', 'payments.status'])
            ->paginate(10);

        return view('payments.payments', compact('payments', $payments));
    }

    public function viewPayment($id){
        $payment = DB::table('payments')
            ->where('payments.id', '=', $id)
            ->join('orders', 'orders.id', '=', 'payments.order_id')
            ->first(['payments.id', 'orders.id as order_id', 'orders.enquiry_id as enquiry_id', 'orders.quotation_id as quotation_id', 'payments.created_at', 'payments.updated_at', 'payments.status','payments.amount','payments.billing_address']);

        if (sizeof($payment) == 0) {
            abort(404);
        };

        return view('payments.payment', compact('payment', $payment));
    }

}
