@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left"><img src="{{asset('css/social-icons/delivery-note.svg')}}" alt="clipboard"
                                  width="15%">Shopping Orders </h3>
            <br><br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
                    <th>
                        Order #
                    </th>

                    <th>
                        Status
                    </th>
                    <th>
                        Payment Status
                    </th>
                    <th>
                        Created At
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($orders as $note)
                    <tr class="clickable" ondblclick="window.location='{{url("/delivery-note/$note->id")}}'">
                        <td>{{$note->id}}</td>
                        <td>{{$note->status}}</td>
                        <td>{{$note->payment_status}}</td>
                        <td>{{\Carbon\Carbon::parse($note->created_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <div class="text-center">
                {{$orders->links()}}
            </div>

        </div>
        <br><br>

    </div>

@endsection
