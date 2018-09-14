<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enquiry;
use App\Order;
use App\Quotation;
use App\User;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(10);

        return view('orders.orders', compact('orders', $orders));
    }

    public function viewOrder($id){
        $order = Order::find($id);
        $user = Customer::find($order->user_id);
        $enquiry = Enquiry::find($order->enquiry_id);
        $quotation = Quotation::find($order->quotation_id);
        $admin = User::find($quotation->admin_id);
        $quotation['admin'] = $admin;
        $data = array('order'     => $order,
                      'user'      => $user,
                      'enquiry'   => $enquiry,
                      'quotation' => $quotation);


        if (sizeof($order) == 0) {
            abort(404);
        };

        return view('orders.order')->with($data);
    }


}
