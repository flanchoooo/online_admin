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
        <div class="card-large card-default card-body">

            @include('partials.session')
            @include('partials.error')

            <h3 class="blue-text"><span><img src="{{asset('css/social-icons/receipt.svg')}}" alt="clipboard"
                                             width="5%"></span> Payment - #{{$payment->id}}({{$payment->status}}
                )(${{$payment->amount}})
            </h3>
            <br>
            Created {{\Carbon\Carbon::parse($payment->created_at)->format('d M Y')}}<br>
            <br>
            <hr>

            <h3 class="blue-text">Billing Address</h3>
            {{$payment->billing_address}}
        </div>
        <br><br>
    </div>

    <div class="col-sm-12">
        <div class="card-large card-default card-body" ng-controller="paymentCtrl">

            @include('partials.session')
            @include('partials.error')

            <h3 class="blue-text"><span><img src="{{asset('css/social-icons/delivery-note.svg')}}" alt="clipboard"
                                             width="5%"></span> Send Delivery Note
            </h3>
            <br>
            <input type="date" class="form-control datepicker" placeholder="Delivery Date" name="delivery_date"
                   id="delivery_date">
            <br>
            <input type="hidden" name="quotation" id="quotation" value="{{$payment->quotation_id}}">
            <input type="hidden" name="enquiry" id="enquiry" value="{{$payment->enquiry_id}}">
            <input type="hidden" name="order" id="order" value="{{$payment->order_id}}">
            <input type="hidden" name="payment" id="payment" value="{{$payment->id}}">

            <div class="right">
                <button class="btn green white-text" style="margin-right: 10px" ng-click="generateDeliveryNote()">Preview Delivery Note</button>
                <button class="btn blue white-text" ng-click="sendDeliveryNote()"><span ng-show="loading"><i class="fa fa-sync fa-spin"></i> Sending...</span><span ng-show="!loading">Send Delivery Note</span></button>
            </div>
        </div>
        <br><br>
    </div>

@endsection