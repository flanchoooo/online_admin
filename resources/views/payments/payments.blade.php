@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left"><img src="{{asset('css/social-icons/receipt.svg')}}" alt="clipboard"
                                  width="20%">Payments </h3>

            <br><br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
                    <th>
                        Payment #
                    </th>
                    <th>
                        Order #
                    </th>
                    <th>
                        Amount
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
                @foreach($payments as $payment)
                    <tr class="clickable" ondblclick="window.location='{{url("/payment/$payment->id")}}'">
                        <td>{{$payment->id}}</td>
                        <td>{{$payment->order_id}}</td>
                        <td>${{$payment->amount}}</td>
                        <td>{{$payment->status}}</td>
                        <td>{{\Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($payment->updated_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <div class="text-center">
                {{$payments->links()}}
            </div>

        </div>
        <br><br>

    </div>

@endsection
