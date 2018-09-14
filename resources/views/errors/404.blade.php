@extends('layouts.app_error')

@section('title')
    Page not found
@stop

@section('content')
    <center>
        <img src="{{asset('css/linear-communication/svg/error-404.svg')}}" alt="404" style="width:55%">
    </center>
    <div class="title">
        Whoops! Page not found.
    </div>
    <h3 class="text-center"><a href="{{url('/home')}}"><i class="fa fa-home"></i> HOME</a></h3>
@stop
