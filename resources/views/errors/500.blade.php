@extends('layouts.app_error')

@section('title')
    Server Error
@stop

@section('content')
    <center>
        <img src="{{asset('css/linear-communication/svg/robot.svg')}}" alt="500" style="width:55%">
    </center>
    <div class="title">
        Server error!
    </div>
    <h3 class="text-center"><a href="/home"><i class="fa fa-home"></i> HOME</a></h3>

@stop
