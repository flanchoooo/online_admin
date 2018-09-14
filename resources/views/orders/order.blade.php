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
        <div class="card-large card-default card-body" ng-controller="orderCtrl">
            <div><h3 class="blue-text">Order - #{{$order->id}}({{$order->status}})</h3>
                <input type="hidden" name="quotation_id" id="quotation_id" value="{{$quotation->id}}">
                <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
                <span class="right"><button style="margin-right: 10px;" class="btn blue white-text"
                                            ng-click="generateQuotation()">View Quotation</button>

                <button class="btn red white-text" ng-click="sendInvoice()"><span ng-show="loading"><i class="fa fa-sync fa-spin"></i> Sending...</span><span ng-show="!loading">Send Invoice</span></button>
                </span>
            </div>
            <br>
            Created {{\Carbon\Carbon::parse($order->created_at)->format('d M Y')}}
            <br>
            <hr>
            <h3 class="blue-text">Customer Details</h3>
            {{$user->name}}<br>
            {{$user->email}}<br>
            {{$user->mobile}}<br>
            <hr>

            <h3 class="blue-text">Enquiry #{{$enquiry->id}}</h3>
            {{$enquiry->name}}<br>
            Created {{Carbon\Carbon::parse($enquiry->created_at)->format('d M Y')}}<br>
            <b>Status</b> - {{$enquiry->status}}<br>
            <b>Description</b> - {{$enquiry->description}}
        </div>
        <br><br>
    </div>

@endsection