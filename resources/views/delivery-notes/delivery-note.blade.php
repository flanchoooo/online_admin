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
        <div class="card-large card-default card-body" ng-controller="paymentCtrl">
            <div><h3 class="blue-text">Delivery - #{{$delivery_note->id}}({{$delivery_note->status}})</h3>

                <input type="hidden" name="quotation" id="quotation" value="{{$delivery_note->quotation_id}}">
                <input type="hidden" name="enquiry" id="enquiry" value="{{$delivery_note->enquiry_id}}">
                <input type="hidden" name="order" id="order" value="{{$delivery_note->order_id}}">
                <input type="hidden" name="payment" id="payment" value="{{$delivery_note->payment_id}}">
                <input type="hidden" name="id" id="id" value="{{$delivery_note->id}}">
                <span class="right"><button style="margin-right: 10px;" class="btn blue white-text"
                                            ng-click="generateSentDeliveryNote()">View Delivery Note</button>

                </span>
            </div>
            <br>
            Created {{\Carbon\Carbon::parse($delivery_note->created_at)->format('d M Y')}}
            <br>
            <hr>
            <h3 class="blue-text">Customer Details</h3>
            {{$delivery_note->user_name}}<br>
            {{$delivery_note->user_email}}<br>
            {{$delivery_note->user_mobile}}<br>
            <hr>

            {{--<h3 class="blue-text">Enquiry #{{$enquiry->id}}</h3>
            {{$enquiry->name}}<br>
            Created {{Carbon\Carbon::parse($enquiry->created_at)->format('d M Y')}}<br>
            <b>Status</b> - {{$enquiry->status}}<br>
            <b>Description</b> - {{$enquiry->description}}--}}
        </div>
        <br><br>
    </div>

@endsection