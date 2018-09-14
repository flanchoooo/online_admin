@extends('layouts.app')

@section('content')

    <div class="col-sm-12">
        <div class="card-large card-default card-body">
            <h2>
                Update Product
            </h2>
            <br><br>

            @include('partials.session')
            @include('partials.error')
            @include('partials.info')

            <form method="post" action="{{url('/product/update')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">

                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input id="name" type="text" placeholder="Item Name"
                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                               value="{{ $product->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-12">
                        <label for="price">Price:</label>
                        <input id="price" step="any" min="1" type="number" placeholder="Price"
                               class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price"
                               value="{{ $product->price }}" required autofocus>

                        @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>


                <div class="form-group row">

                    <div class="col-md-12">
                        <label for="category">Category({{$product->category}}):</label>
                        <select id="category"
                                class="select form-control{{ $errors->has('category') ? ' is-invalid' : '' }}"
                                required autofocus name="category">
                            <option value="" selected>Select Category</option>
                            <option value="Pain Management">Pain Management</option>
                            <option value="Wound Management">Wound Management</option>
                            <option value="Oral Care">Oral Care</option>
                            <option value="Skin Conditions">Skin Conditions</option>
                            <option value="Oral Health">Oral Health</option>
                            <option value="Sports Nutrition">Sports Nutrition</option>
                            <option value="Vitamins">Vitamins</option>
                            <option value="Herbal">Herbal</option>
                            <option value="Pregnancy">Pregnancy</option>
                            <option value="Baby">Baby</option>
                            <option value="Body Skin Care">Body Skin Care</option>
                            <option value="Deodorant">Deodorant</option>
                            <option value="Hair Care">Hair Care</option>
                            <option value="Make Up">Make Up</option>
                            <option value="Sun Protection">Sun Protection</option>
                            <option value="Nappies and Wipes">Nappies and Wipes</option>
                            <option value="Pregnancy">Pregnancy and Planning for the Baby</option>
                            <option value="Baby Feeding">Baby Feeding</option>
                        </select>


                    @if ($errors->has('category'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-12">
                        <label for="status">Status:</label><select id="status"
                                                                   class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                                   required autofocus name="status">
                            <option value="" selected>Select Category</option>
                            <option value="Pending" {{ ( $product->status == 'Pending' ) ? ' selected' : '' }}>
                                Pending
                            </option>
                            <option value="Active" {{ ( $product->status == 'Active' ) ? ' selected' : '' }}>Active
                            </option>
                            <option value="Blocked" {{ ( $product->status == 'Blocked' ) ? ' selected' : '' }}>
                                Blocked
                            </option>
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

                <div class="form-group row mb-0">
                    <div class="col-md-6">
                        <button type="submit" class="btn blue white-text">
                            Update product
                        </button>
                    </div>
                </div>
            </form>

            <br>
            <h3>
                Media
            </h3>
            <hr>
            @foreach($product->getMedia('products') as $media)
                <a class="chip btn pizza-hut-red-text" href="{{ url($media->getUrl()) }}" target="_blank">
                    {{$media->name}} <i class="fa fa-download"></i>
                </a>
                <a style="margin: 15px" href="{{url("/product/delete/media?id=$product->id&media_id=$media->id")}}">
                    <i class="fa fa-times red-text"></i>
                </a>
                <br><br>
            @endforeach

        </div>

        <br><br>

    </div>

@endsection
