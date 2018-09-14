@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')

    <div ng-controller="productCtrl">
        <div class="col-md-12">
            <div class="card-large card-default card-body">

                <h2 class="left"><img src="{{asset('css/social-icons/shopping-cart.svg')}}" alt="clipboard"
                                      width="7%">
                    Shopping Items


                </h2>
                <h2 class="right" style="font-size: medium;"><a href="{{url('/shopping-item/add')}}"
                                                                style="color: inherit"><i
                                class="fa fa-plus-circle pizza-hut-red-text"></i>Add Product</a></h2>

                <br><br>
                @include('partials.session')
                @include('partials.error')
                @include('partials.info')
                <table class="table  table-hover table-bordered table-responsive{-sm|-md|-lg|-xl}">
                    <caption>Double Click to View More Details</caption>
                    <thead class="thead-light">
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Status
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $order)
                        <tr class="clickable" ondblclick="window.location='{{url("/product/$order->id")}}'">
                            <td>{{$order->name}}</td>
                            <td>{{$order->category}}</td>
                            <td>${{$order->price}}</td>
                            <td>{{$order->status}}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection
