<?php

namespace App\Http\Controllers;

use App\DeliveryNote;
use App\Enquiry;
use App\Invoice;
use App\Order;
use App\Payment;
use App\Quotation;
use App\ShoppingItem;
use App\ShoppingOrder;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenuData(Request $request){
        $enquiries = Enquiry::count();
        $orders = Order::count();
        $payments = Payment::count();
        $quotations = Quotation::count();
        $invoices = Invoice::count();
        $delivery_notes = DeliveryNote::count();
        $shopping_items = ShoppingItem::count();
        $shopping_orders = ShoppingOrder::count();

        return array(
            'Enquiries'      => $enquiries,
            'Orders'         => $orders,
            'Payments'       => $payments,
            'Quotations'     => $quotations,
            'Invoices'       => $invoices,
            'DeliveryNotes'  => $delivery_notes,
            'ShoppingItems'  => $shopping_items,
            'ShoppingOrders' => $shopping_orders,
        );
    }

    public function getTemplate(){
        return view('quotations.template');
    }
}
