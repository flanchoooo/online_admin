<?php

namespace App\Http\Controllers;

use App\ShoppingOrder;
use GuzzleHttp;

class ShoppingOrderController extends Controller
{
    public function index(){
        $orders = ShoppingOrder::paginate(10);

        $this->checkShoppingPayments();

        return view('shopping-orders.orders', compact('orders', $orders));
    }


    public function checkShoppingPayments(){
        $client = new GuzzleHttp\Client();

        $res = $client->get(env('APP_URL') . '/paynow/check');
        $res->getBody()->getContents();

    }
}
