<div class="container" ng-app="menuApp" ng-controller="mainCtrl" ng-cloak>
    <div class="row" >
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/clipboards/svg/005-clipboards-10.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/home')}}" class="blue-text clickable">Enquiries (<span ng-bind="data.Enquiries"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/quote.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/quotes')}}" class="blue-text clickable">Quotations(<span ng-bind="data.Quotations"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/clipboards/svg/008-clipboards-7.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/orders')}}" class="blue-text clickable">Orders(<span ng-bind="data.Orders"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/invoice.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/invoices')}}" class="blue-text clickable">Invoices(<span ng-bind="data.Invoices"></span>)</a>
                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/receipt.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/payments')}}" class="blue-text clickable">Payments(<span ng-bind="data.Payments"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/delivery-note.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/delivery-notes')}}" class="blue-text clickable" style="font-size: small">Delivery Notes(<span ng-bind="data.DeliveryNotes"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/shopping-cart.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/shopping-items')}}" class="blue-text clickable" style="font-size: small">Shopping Items(<span ng-bind="data.ShoppingItems"></span>)</a>
                </p>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 ">
            <div class="card card-default card-body card-hover shadow-1">
                <p class="blue-text">
                    <img src="{{asset('css/social-icons/shopping-orders.svg')}}" alt="clipboard" width="20%">

                    <a href="{{url('/shopping-orders')}}" class="blue-text clickable" style="font-size: small">Store Orders(<span ng-bind="data.ShoppingOrders"></span>)</a>
                </p>
            </div>
        </div>

    </div>

    <hr>
    <div class="row">
    </div>

</div>
