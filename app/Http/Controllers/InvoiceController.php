<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enquiry;
use App\Invoice;
use App\Mail\InvoiceRequest;
use App\Order;
use App\Quotation;
use App\QuotationItem;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class InvoiceController extends Controller
{
    public function index(){
        $invoices = DB::table('invoices')
            ->join('administrators', 'invoices.admin_id', '=', 'administrators.id')
            ->select('invoices.id', 'invoices.status', 'administrators.name as admin_name', 'invoices.created_at', 'invoices.updated_at')
            ->paginate(10);
        //return $invoices;
        return view('invoices.invoices', compact('invoices', $invoices));
    }

    public function sendInvoice(Request $request){
        $quotation_items = QuotationItem::whereQuotationId($request->quotation)
            ->get();

        $quotation = Quotation::find($request->quotation);
        $enquiry = Enquiry::find($quotation->enquiry_id);
        $order = Order::find($request->order);
        $customer = Customer::find($quotation_items[0]['user_id']);
        $invoice = Invoice::create([
            'user_id'  => $quotation_items[0]['user_id'],
            'order_id' => $request->order,
            'admin_id' => Auth::user()->id,
            'status'   => 'Sent',
        ]);
        $quotation->status = 'Invoice Sent';
        $quotation->save();

        $enquiry->status = 'Invoice Sent';
        $enquiry->save();

        $order->status = 'Invoice Sent';
        $order->save();
        $total = 0;

        foreach ($quotation_items as $quotation_item) {
            $total += ($quotation_item['qty'] * $quotation_item['price']) - $quotation_item['deducted'] ;
        }


        $data = array('total'    => $total,
                      'items'    => $quotation_items,
                      'user'     => $quotation_items[0]['user_id'],
                      'customer' => $customer,
                      'invoice'  => $invoice->id);


        $pdf = PDF::loadView('invoices.template', $data);
        try {
            Mail::to($customer->email)->send(new InvoiceRequest($customer, $pdf->output(), $quotation->enquiry_id, $invoice->id));

            return 'Invoice Sent!(Please refresh page)';
        } catch (Exception $exception) {
            return 'Invoice Failed to Send!';

        }
    }

    public function viewInvoice($id){
        $invoice = DB::table('invoices')
            ->where('invoices.id', '=', $id)
            ->join('orders', 'orders.id', '=', 'invoices.order_id')
            ->first(['invoices.id', 'orders.id as order_id', 'orders.enquiry_id as enquiry_id', 'orders.quotation_id as quotation_id', 'invoices.created_at', 'invoices.updated_at', 'invoices.status']);

        $quotation_items = QuotationItem::whereQuotationId($invoice->quotation_id)
            ->get();
        $total = 0;

        foreach ($quotation_items as $quotation_item) {
            $total += ($quotation_item['qty'] * $quotation_item['price']) - $quotation_item['deducted'] ;
        }
        $invoice->total = $total;
        if (sizeof($invoice) == 0) {
            abort(404);
        };

        return view('invoices.invoice', compact('invoice', $invoice));
    }

}
