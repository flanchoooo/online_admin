@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left"><img src="{{asset('css/clipboards/svg/008-clipboards-7.svg')}}" alt="clipboard"
                                  width="20%">
                Orders </h3>
            <br><br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
                    <th>
                        Order Number
                    </th>
                    <th>
                        Quotation Number
                    </th>
                    <th>
                        Enquiry Number
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
                @foreach($orders as $order)
                    <tr class="clickable" ondblclick="window.location='{{url("/order/$order->id")}}'">
                        <td>{{$order->id}}</td>
                        <td>{{$order->enquiry_id}}</td>
                        <td>{{$order->quotation_id}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($order->updated_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach

                </tbody>


            </table>

        </div>
        <br><br>

    </div>

@endsection
