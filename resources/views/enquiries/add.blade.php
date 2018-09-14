@extends('layouts.app')

@section('content')
    @include('partials.home_menu.menu')
    <div class="col-sm-12">
        <div class="card-large card-body white shadow-1">
            <h2>Make Enquiry</h2>
            <br>
            @include('partials.session')


            <form method="POST" action="{{ url('/enquiry/create') }}" enctype="multipart/form-data">
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
                        <select id="type"
                                class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                required autofocus name="type">
                            <option value="" selected>Select Enquiry Type</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-12">
                            <textarea placeholder="Description"
                                      class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                      name="description"
                                      required></textarea>

                        @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
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
                        <input id="description" type="text" placeholder="File Description"
                               class="form-control{{ $errors->has('file_description') ? ' is-invalid' : '' }}"
                               name="description" required>

                        @if ($errors->has('file_description'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('file_description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">
                            Make Enquiry
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>

@endsection
