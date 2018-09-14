@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left"><img src="{{asset('css/social-icons/delivery-note.svg')}}" alt="clipboard"
                                  width="15%">Delivery Notes </h3>
            <br><br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
                    <th>
                        Delivery Note #
                    </th>
                    <th>
                        Payment #
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Processed By
                    </th>
                    <th>
                        Delivery Address
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
                @foreach($delivery_notes as $note)
                    <tr class="clickable" ondblclick="window.location='{{url("/delivery-note/$note->id")}}'">
                        <td>{{$note->id}}</td>
                        <td>{{$note->payment_id}}</td>
                        <td>{{$note->status}}</td>
                        <td>{{$note->name}}</td>
                        <td>{{$note->billing_address}}</td>
                        <td>{{\Carbon\Carbon::parse($note->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($note->updated_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <div class="text-center">
                {{$delivery_notes->links()}}
            </div>

        </div>
        <br><br>

    </div>

@endsection
