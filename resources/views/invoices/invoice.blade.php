@extends('layouts.app')
@section('styles')
    <style>
        .pagination {
            display: inline-flex;
            margin: 0 auto;
        }
    </style>

@endsection
@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body" ng-controller="invoiceCtrl">

            @include('partials.session')
            @include('partials.error')

            <h3 class="blue-text"><span><img src="{{asset('css/social-icons/quote.svg')}}" alt="clipboard"
                                             width="5%"></span> Invoice - #{{$invoice->id}}({{$invoice->status}})
            </h3>
            <input type="hidden" name="quotation" id="quotation" value="{{$invoice->quotation_id}}">
            <br>
            Created {{\Carbon\Carbon::parse($invoice->created_at)->format('d M Y')}}

            <input type="hidden" name="invoice" id="invoice" value="{{$invoice->id}}">
            <input type="hidden" name="order" id="order" value="{{$invoice->order_id}}">
            <br>
            <hr>
            <h3 class="blue-text">
                View Sent Invoice
            </h3>
            <br>
            <a class="chip btn blue-text" ng-click="generateInvoice()">Invoice <i class="fa fa-download"></i></a>
            <br>
            <hr>
            <h3 class="blue-text">
                Add Billing Address
            </h3>
            <br>
            <input type="text" class="form-control" name="billing_address" id="billing_address" placeholder="Enter Billing Address">
            <br>
            <hr>
            <h3 class="blue-text">
                Make Payment
            </h3>
            <br>
            <h5> Total: $ {{number_format($invoice->total,2,',','.')}}
            </h5>

            <input type="hidden" name="amount" id="amount" value="{{$invoice->total}}">
            <br>
            <hr>
            <a class="chip btn red white-text" ng-click="paynow()"><span ng-show="loading"><i
                            class="fa fa-sync fa-spin"></i> Processing...</span><span ng-show="!loading">Pay via Ecocash or Telecash</span></a>
            <br><br>
            <p style="font-size: small; font-weight: bold"><i>(You will be redirected to Paynow to complete your
                    payment.)</i></p>
        </div>
        <br><br>
    </div>

@endsection