<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DeliveryNote;
use App\Enquiry;
use App\Mail\DeliveryNoteAlert;
use App\Order;
use App\Payment;
use App\Quotation;
use App\QuotationItem;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class DeliveryNoteController extends Controller
{
    public function index(){
        $delivery_notes = DB::table('delivery_notes')
            ->join('orders', 'orders.id', '=', 'delivery_notes.order_id')
            ->join('administrators', 'administrators.id', '=', 'delivery_notes.admin_id')
            ->select('delivery_notes.id','delivery_notes.payment_id','administrators.name as name','delivery_notes.created_at','delivery_notes.updated_at','delivery_notes.status','delivery_notes.billing_address')
            ->paginate(10);
        return view('delivery-notes.delivery-notes',compact('delivery_notes',$delivery_notes));
    }

    public function viewDeliveryNote($id){
        $delivery_note = DB::table('delivery_notes')
            ->where('delivery_notes.id', '=', $id)
            ->join('orders', 'orders.id', '=', 'delivery_notes.order_id')
            ->join('users', 'users.id', '=', 'delivery_notes.user_id')
            ->first(['delivery_notes.id','users.name as user_name','users.email as user_email','users.mobile as user_mobile', 'orders.id as order_id', 'orders.enquiry_id as enquiry_id', 'orders.quotation_id as quotation_id', 'delivery_notes.created_at', 'delivery_notes.updated_at', 'delivery_notes.status','delivery_notes.billing_address','delivery_notes.payment_id']);

        if (sizeof($delivery_note) == 0) {
            abort(404);
        };

        return view('delivery-notes.delivery-note', compact('delivery_note', $delivery_note));
    }

    public function confirmDelivery(Request $request){

    }

    public function sendDeliveryNote(Request $request){
        $quotation_items = QuotationItem::whereQuotationId($request->quotation)
            ->get();

        $quotation = Quotation::find($request->quotation);
        $enquiry = Enquiry::find($quotation->enquiry_id);
        $order = Order::find($request->order);
        $customer = Customer::find($quotation_items[0]['user_id']);
        $payment = Payment::find($request->payment);
        $delivery_note = DeliveryNote::create([
            'user_id'         => $quotation_items[0]['user_id'],
            'order_id'        => $request->order,
            'admin_id'        => Auth::user()->id,
            'delivery_date'   => Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            'payment_id'      => $request->payment,
            'status'          => 'Sent',
            'billing_address' => $payment->billing_address,
        ]);
        $quotation->status = 'Delivery Note Sent';
        $quotation->save();

        $enquiry->status = 'Delivery Note Sent';
        $enquiry->save();

        $order->status = 'Delivery Note Sent';
        $order->save();


        $data = array(
            'items'           => $quotation_items,
            'user'            => $quotation_items[0]['user_id'],
            'customer'        => $customer,
            'delivery_note'         => $delivery_note->id,
            'date'            => $request->date,
            'billing_address' => $payment->billing_address);
        $pdf = PDF::loadView('delivery-notes.template', $data);
        try {
            Mail::to($customer->email)->send(new DeliveryNoteAlert($customer, $pdf->output(), $order->id, $delivery_note->id));

            return 'Delivery Note!(Please refresh page)';
        } catch (Exception $exception) {
            return 'Delivery Note Failed to Send!';

        }
    }

    public function generateDeliveryNote(Request $request){
        $quotation_items = QuotationItem::whereQuotationId($request->quotation)
            ->get();

        $quotation = Quotation::find($request->quotation);
        $enquiry = Enquiry::find($quotation->enquiry_id);
        $order = Order::find($request->order);
        $customer = Customer::find($quotation_items[0]['user_id']);
        $payment = Payment::find($request->payment);

        $data = array(
            'items'           => $quotation_items,
            'user'            => $quotation_items[0]['user_id'],
            'customer'        => $customer,
            'delivery_note'   => 1,
            'date'            => Carbon::now()->format('d M Y'),
            'billing_address' => $payment->billing_address);


        $pdf = PDF::loadView('delivery-notes.template', $data);

        return $pdf->download('delivery-note.pdf');

    }

    public function generateSentDeliveryNote(Request $request){
        $quotation_items = QuotationItem::whereQuotationId($request->quotation)
            ->get();

        $quotation = Quotation::find($request->quotation);
        $delivery_note = DeliveryNote::find($request->id);
        $order = Order::find($request->order);
        $customer = Customer::find($quotation_items[0]['user_id']);
        $payment = Payment::find($request->payment);

        $data = array(
            'items'           => $quotation_items,
            'user'            => $quotation_items[0]['user_id'],
            'customer'        => $customer,
            'delivery_note'   => $delivery_note->id,
            'date'            => Carbon::parse($delivery_note->delivery_date)->format('d M Y'),
            'billing_address' => $payment->billing_address);


        $pdf = PDF::loadView('delivery-notes.template', $data);

        return $pdf->download('delivery-note.pdf');

    }

}
