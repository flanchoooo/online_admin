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
            <h3 class="blue-text">Enquiry - #{{$enquiry->id}}({{$enquiry->status}})</h3>
            <br>
            Created {{\Carbon\Carbon::parse($enquiry->created_at)->format('d M Y')}}

            <hr>
            <br>
            <h3 class="blue-text">
                Customer Details
            </h3>
            <br>
            {{json_decode($enquiry->customer)->name}}<br>
            {{json_decode($enquiry->customer)->email}}<br>
            {{json_decode($enquiry->customer)->mobile}}<br>
            <br>
            <hr>
            <h3 class="blue-text">
                Address
            </h3>
            <br>
            {{ $enquiry->address }}
            <br>
            <hr>
            <h3 class="blue-text">
                Payment Method
            </h3>
            <br>
            {{ $enquiry->payment_method }}
            <br>
            <hr>
            <h3 class="blue-text">
                Item Name
            </h3>
            <br>
            {{ $enquiry->name }}
            <br>

            <hr>
            <h3 class="blue-text">
                Description
            </h3>
            <br>
            {{$enquiry->description}}
            <br>
            <hr>
            <br>
            <h3 class="blue-text">
                Files
            </h3>
            <hr>
            @foreach($enquiry->getMedia('enquiries') as $media)

                <a class="chip btn" href="{{ url($media->getUrl()) }}" target="_blank">
                    {{$media->name}} <i class="fa fa-download"></i>
                </a>
            @endforeach
        </div>
        <br><br>
    </div>
    <div class="col-sm-12" ng-controller="quotationCtrl">
        <div class="card-large card-default card-body">
            <h3 class="center blue-text">
                Create Quotation
            </h3>
            <br><br>
            <div>
                <label for="test">
                    Select Stock Item
                </label><select name="test" class="select" id="test"
                                ng-model="stock"
                                ng-options="stock.item_description for stock in stocks track by stock.id">
                </select>
                <br>
                <button type="button" class="btn btn-primary right" ng-click="add()">Add item</button>
                <br>
            </div>
            <br><br><br>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Covered by Medical Aid</th>
                    <th>Shortfall</th>
                    <th>Total</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="item in invoice.items">
                    <td><input type="text" ng-model="item.name" class="form-control" disabled/></td>
                    <td><input type="number" ng-model="item.qty" class="form-control"/></td>
                    <td><input type="number" ng-model="item.price" class="form-control"/></td>
                    <td><input type="number" ng-model="item.deducted" class="form-control"/></td>
                    <td>@{{(item.qty * item.price) - item.deducted | currency}}</td>
                    <td>@{{(item.qty * item.price) - item.deducted | currency}}</td>
                    <td>
                        <button type="button" class="btn btn-danger" ng-click="remove($index)">Delete</button>
                    </td>
                </tr>
                <tr>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total :</td>
                    <td>@{{total() | currency}}</td>
                </tr>
                </tbody>
            </table>

            <br>
            <hr>
            <form>
                <input type="hidden" id="customer_id" value={{json_decode($enquiry->customer)->id}}>
                <input type="hidden" id="enquiry_id" value={{$enquiry->id}}>
            </form>
            <div class="right">
                <button class="btn green white-text" ng-click="preview()">Preview Quotation</button>
                <button class="btn blue white-text" ng-click="send()"><span ng-show="loading"><i
                                class="fa fa-sync fa-spin"></i> Sending...</span><span
                            ng-show="!loading">Send Quotation</span></button>
            </div>
        </div>
    </div>
@endsection
