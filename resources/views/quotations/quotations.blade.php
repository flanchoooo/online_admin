@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h3 class="left">Quotations </h3>
            <br><br>
            <table class="table table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                <caption>Double Click to View More Details</caption>
                <thead>
                <tr>
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
                    <th>
                        Processed By
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($quotations as $quotation)
                    <tr class="clickable" ondblclick="window.location='{{url("/quotation/$quotation->id")}}'">
                        <td>{{$quotation->id}}</td>
                        <td>{{$quotation->enquiry_id}}</td>
                        <td>{{$quotation->status}}</td>
                        <td>{{\Carbon\Carbon::parse($quotation->created_at)->diffForHumans()}}</td>
                        <td>{{\Carbon\Carbon::parse($quotation->updated_at)->diffForHumans()}}</td>
                        <td>{{$quotation->admin_name}}</td>
                    </tr>
                @endforeach
                </tbody>


            </table>

        </div>
        <br><br>

    </div>

@endsection
