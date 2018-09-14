angular.module('menuApp', [])
    .controller('mainCtrl', ['$scope', '$http', '$timeout', function ($scope, $http, $timeout) {
        var loadTime = 1000, //Load the data every second
            errorCount = 0, //Counter for the server errors
            loadPromise; //Pointer to the promise created by the Angular $timeout service

        var getData = function () {
            $http.get('/menu/data')

                .then(function (res) {
                    $scope.data = res.data;
                    errorCount = 0;
                    nextLoad();
                })

                .catch(function (res) {
                    $scope.data = 'Server error';
                    nextLoad(++errorCount * 2 * loadTime);
                });
        };

        var cancelNextLoad = function () {
            $timeout.cancel(loadPromise);
        };

        var nextLoad = function (mill) {
            mill = mill || loadTime;

            //Always make sure the last timeout is cleared before starting a new one
            cancelNextLoad();
            loadPromise = $timeout(getData, mill);
        };


        //Start polling the data from the server
        getData();


        //Always clear the timeout when the view is destroyed, otherwise it will keep polling and leak memory
        $scope.$on('$destroy', function () {
            cancelNextLoad();
        });

        $scope.data = 'Loading...';
    }])

    .controller('quotationCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {
        $http.get('/stocks/get')
            .then(function (data) {
                $scope.stocks = data.data;
            }, function (error) {
                console.log(error)
            });
        $scope.stock = {};
        $scope.customer_id = 0;
        $scope.loading = false;
        $scope.invoice = {
            items: []
        };
        $scope.add = function () {
            if (Object.keys($scope.stock).length == 0) {
                return
            }
            $scope.invoice.items.push({
                name       : $scope.stock.item_description,
                description: $scope.stock.item_description,
                qty        : 1,
                deducted   : 0,
                price      : Number($scope.stock.price)
            });
            console.log($scope.invoice)
        },
            $scope.remove = function (index) {
                $scope.invoice.items.splice(index, 1);
            },
            $scope.total = function () {
                var total = 0;
                angular.forEach($scope.invoice.items, function (item) {
                    total += (item.qty * item.price) - item.deducted;
                });
                return total;
            };

        $scope.preview = function () {
            if ($scope.total() == 0) {
                return
            }
            var data = {
                total: $scope.total(),
                items: $scope.invoice.items,
                user : $('#customer_id').val()
            };
            $window.open('/quotation/preview?' + $.param(data), '_blank')
        }

        $scope.send = function () {
            $scope.loading = true;

            if ($scope.total() == 0) {
                return
            }
            var data = {
                total  : $scope.total(),
                items  : $scope.invoice.items,
                user   : $('#customer_id').val(),
                enquiry: $('#enquiry_id').val()
            };
            $http.post('/quotation/send', data)
                .then(function (data) {
                    swal(data.data)
                    $scope.loading = false;
                }, function (error) {
                    $scope.loading = false;
                    console.log(error)
                });
        }

        $scope.generate = function () {
            var data = {
                id: $('#quotation_id').val()
            };
            $window.open('/quotation?' + $.param(data), '_blank')

        }
    }])
    .controller('orderCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {
        $scope.loading = false;

        $scope.sendInvoice = function () {
            $scope.loading = true;
            var data = {
                enquiry  : $('#enquiry_id').val(),
                order    : $('#order_id').val(),
                quotation: $('#quotation_id').val(),
            };
            $http.post('/invoice/send', data)
                .then(function (data) {
                    swal('', data.data, 'success')
                    $scope.loading = false;
                }, function (error) {
                    swal('', 'Something went wrong. Please try again!', 'error')
                    console.log(error)
                });
        };
        $scope.generateQuotation = function () {
            var data = {
                id: $('#quotation_id').val()
            };
            $window.open('/quotation?' + $.param(data), '_blank')
        }
    }])
    .controller('paymentCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {
        $scope.loading = false;

        $scope.sendDeliveryNote = function () {
            if ($('#delivery_date').val().length == 0) {
                swal('', 'The Delivery Date is required!', 'warning');
                return;
            }
            $scope.loading = true;
            var data = {
                enquiry  : $('#enquiry').val(),
                order    : $('#order').val(),
                quotation: $('#quotation').val(),
                payment  : $('#payment').val(),
                date     : $('#delivery_date').val(),
            };
            $http.post('/delivery-note/send', data)
                .then(function (data) {
                    swal('', data.data, 'success')
                    $scope.loading = false;
                }, function (error) {
                    swal('', 'Something went wrong. Please try again!', 'error');
                    $scope.loading = false;
                    console.log(error)
                });
        };
        $scope.generateDeliveryNote = function () {
            if ($('#delivery_date').val().length == 0) {
                swal('', 'The Delivery Date is required!', 'warning');
                return;
            }
            var data = {
                enquiry  : $('#enquiry').val(),
                order    : $('#order').val(),
                quotation: $('#quotation').val(),
                payment  : $('#payment').val(),
                date     : $('#delivery_date').val(),

            };
            $window.open('/delivery-note?' + $.param(data), '_blank')
        }
        $scope.generateSentDeliveryNote = function () {

            var data = {
                enquiry  : $('#enquiry').val(),
                order    : $('#order').val(),
                quotation: $('#quotation').val(),
                payment  : $('#payment').val(),
                id       : $('#id').val(),

            };
            $window.open('/delivery-note/sent?' + $.param(data), '_blank')
        }
    }])
    .controller('productCtrl', ['$scope', '$http', '$window', function ($scope, $http, $window) {
        $scope.loading = false;

        $http.get('/product/get')
            .then(function (data) {
                $scope.products = data.data;
            }, function (error) {
                console.log(error)
            });


    }]);

