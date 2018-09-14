<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Enquiry;
use App\Mail\QuotationRequest;
use App\Quotation;
use App\QuotationItem;
use App\Stock;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class QuotationController extends Controller
{
    public function index(){
        $quotations = DB::table('quotations')
            ->join('administrators', 'quotations.admin_id', '=', 'administrators.id')
            ->join('users', 'quotations.user_id', '=', 'users.id')
            ->select('quotations.id', 'quotations.enquiry_id', 'quotations.status', 'administrators.name as admin_name', 'users.name as user_name', 'quotations.created_at', 'quotations.updated_at')
            ->paginate(10);

        return view('quotations.quotations', compact('quotations', $quotations));
    }

    public function previewQuotation(Request $request){
        $data = $request->all();
        $data['customer'] = Customer::find($request->user);
        $data['quotation'] = 0;

        $pdf = PDF::loadView('quotations.template', $data);

        return $pdf->download('quotation.pdf');
    }

    public function createQuotation(Request $request){
        $data = $request->all();
        $customer = Customer::find($request->user);
        $enquiry = Enquiry::find($request->enquiry);
        $quotation = Quotation::create([
            'user_id'    => $customer->id,
            'admin_id'   => Auth::user()->id,
            'enquiry_id' => $request->enquiry,
        ]);
        $data['customer'] = $customer;
        $data['quotation'] = $quotation->id;
        $items = $request->items;

        foreach ($items as $item) {
            QuotationItem::create([
                'user_id'      => $customer->id,
                'quotation_id' => $quotation->id,
                'name'         => $item['name'],
                'description'  => $item['description'],
                'qty'          => $item['qty'],
                'price'        => $item['price'],
                'deducted'     => $item['deducted'],
            ]);
        }


        $pdf = PDF::loadView('quotations.template', $data);
        try {
            Mail::to($customer->email)->send(new QuotationRequest($customer, $pdf->output(), $request->enquiry, $quotation->id));
            $enquiry->status = 'Quotation Sent';
            $enquiry->save();

            return 'Quotation Sent!(Please refresh page)';
        } catch (Exception $exception) {
            return 'Quotation Failed to Send!';

        }

    }

    public function viewQuotation($id){
        $quotation = DB::table('quotations')
            ->where('quotations.id', '=', $id)
            ->join('administrators', 'quotations.admin_id', '=', 'administrators.id')
            ->join('users', 'quotations.user_id', '=', 'users.id')
            ->join('enquiries', 'quotations.enquiry_id', '=', 'enquiries.id')
            ->select('quotations.id', 'quotations.enquiry_id', 'quotations.status', 'administrators.name as admin_name', 'users.name as user_name', 'users.email as user_email', 'users.mobile as user_mobile', 'enquiries.name as enquiry_name', 'quotations.created_at', 'quotations.updated_at')
            ->first();

        if (sizeof($quotation) == 0) {
            abort(404);
        };
        $data = ['quotation' => $quotation];

        return view('quotations.quotation')->with($data);
    }

    public function generateQuotation(Request $request){
        $quotation_items = QuotationItem::whereQuotationId($request->id)
            ->get();
        $customer = Customer::find($quotation_items[0]['user_id']);
        $total = 0;

        foreach ($quotation_items as $quotation_item) {
            $total += ($quotation_item['qty'] * $quotation_item['price']) - $quotation_item['deducted'] ;
        }

        $data = array('total'     => $total,
                      'items'     => $quotation_items,
                      'user'      => $quotation_items[0]['user_id'],
                      'customer'  => $customer,
                      'quotation' => $request->id);


        $pdf = PDF::loadView('quotations.template', $data);

        return $pdf->download('quotation.pdf');
    }

    public function getStocks(Request $request){
        $stocks = Stock::all();

        return $stocks;
    }


}
