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
            <h3 class="left">Enquiries </h3>
            <br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
                    <th>
                        Enquiry Number
                    </th>
                    <th>
                        Item
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Created At
                    </th>
                    <th>
                        Updated At
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($enquiries as $order)
                    <tr class="clickable" ondblclick="window.location='{{url("/enquiry/$order->id")}}'">
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($order->updated_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <div class="text-center">
                {{$enquiries->links()}}
            </div>

        </div>

        <br><br>

    </div>

@endsection
