<?php

namespace App\Http\Controllers;

use App\Enquiry;
use  Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $enquiries = Enquiry::paginate(10);

        return view('enquiries.enquiries', compact('enquiries', $enquiries));
    }
    public function pdf(){
        $pdf = PDF::loadView('quotations.template',['dean'=>'Dean']);
        return $pdf->download('invoice.pdf');
    }

}
