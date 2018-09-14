@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')

    <div ng-controller="productCtrl">
        <div class="col-md-12">
            <div class="card-large card-default card-body">
                <h2>
                    <i class=""></i> Add Product
                </h2>

                <br>
                @include('partials.session')
                @include('partials.error')
                @include('partials.info')


                <form method="POST" action="{{ url('/product/create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="name" type="text" placeholder="Item Name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="price" step="any" type="number" placeholder="Price"
                                   class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price"
                                   value="{{ old('price') }}" required autofocus>

                            @if ($errors->has('price'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <input id="file" type="file" placeholder="File"
                                   class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file"
                                   value="{{ old('file') }}">

                            @if ($errors->has('file'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12">
                            <select id="category"
                                    class="select form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                    required autofocus name="category">
                                <option value="" selected>Select Category</option>
                                <option value="Cough">Printers</option>
                                <option value="Pain Management">Tills & Readers</option>
                                <option value="Wound Management">Servers</option>
                                <option value="Oral Care">Software Solutions</option>
                            </select>

                            @if ($errors->has('status'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-12">
                            <select id="status"
                                    class="select form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                    required autofocus name="status">
                                <option value="" selected>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Active">Active</option>
                            </select>

                            @if ($errors->has('status'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn blue white-text">
                                Add Product
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
