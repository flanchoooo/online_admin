@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left"><img src="{{asset('css/social-icons/invoice.svg')}}" alt="clipboard"
                                  width="20%">Invoices </h3>
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
                        Processed By
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
                @foreach($invoices as $invoice)
                    <tr class="clickable" ondblclick="window.location='{{url("/invoice/$invoice->id")}}'">
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->status}}</td>
                        <td>{{$invoice->admin_name}}</td>
                        <td>{{\Carbon\Carbon::parse($invoice->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($invoice->updated_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            <br>
            <div class="text-center">
                {{$invoices->links()}}
            </div>

        </div>
        <br><br>

    </div>

@endsection
