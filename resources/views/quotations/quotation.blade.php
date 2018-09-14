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
        <div class="card-large card-default card-body" ng-controller="quotationCtrl">
            <h3 class="blue-text">Quotations - #{{$quotation->id}}({{$quotation->status}})</h3>
            <br>
            Created {{\Carbon\Carbon::parse($quotation->created_at)->format('d M Y')}}
            <br>
            Processed By {{$quotation->admin_name}}

            <hr>
            <br>
            <h3 class="blue-text">
                Customer Details
            </h3>
            <br>
            {{$quotation->user_name}}<br>
            {{$quotation->user_email}}<br>
            {{$quotation->user_mobile}}<br>
            <br>
            <hr>
            <h3 class="blue-text">
                Enquiry Name
            </h3>
            <br>
            {{ $quotation->enquiry_name }}
            <input type="hidden" name="quotation_id" id="quotation_id" value="{{$quotation->id}}">
            <br>
            <hr>
            <h3 class="blue-text">
                Quotation
            </h3>
            <br>
            <a class="chip btn blue-text" ng-click="generate()">Quotation <i class="fa fa-download"></i></a>

        </div>
        <br><br>
    </div>

@endsection