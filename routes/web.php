<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('welcome');
});
/*
 * AUTHENTICATION ROUTES
 * */
Auth::routes();
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

/*
 * VIEW ROUTES
 * */
Route::group(['middleware' => 'auth'], function (){
    Route::post('/register/mobile', 'DetailsController@updateMobile');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::any('/pdf', 'HomeController@pdf');
    Route::get('/privacy', 'HomeController@index')->name('home');
    Route::get('/orders', 'OrderController@index')->name('orders');
    Route::get('/payments', 'PaymentController@index')->name('payments');
    Route::get('/delivery-notes', 'DeliveryNoteController@index')->name('delivery-notes');
    Route::get('/invoices', 'InvoiceController@index')->name('invoices');
    Route::get('/quotes', 'QuotationController@index')->name('quotes');
    Route::get('/profile', 'PaymentController@index')->name('profile');
    Route::get('/shopping-items', 'ShoppingItemController@index')->name('shopping_items');
    Route::get('/shopping-orders', 'ShoppingOrderController@index')->name('shopping_items');
    Route::get('/shopping-item/add', 'ShoppingItemController@addIndex')->name('shopping_items_add');
    Route::get('/enquiry/add', 'EnquiryController@viewAdd')->name('add_enquiry');
    Route::post('/enquiry/update', 'EnquiryController@update')->name('update_enquiry');
    Route::any('/enquiry/delete/media', 'EnquiryController@deleteMedia')->name('delete_enquiry_media');
    Route::get('/enquiry/{id}', 'EnquiryController@viewEnquiry')->name('view_enquiry');
    Route::any('/menu/data', 'MenuController@getMenuData');
    Route::any('/menu/template', 'MenuController@getTemplate');
    Route::any('/quotation/preview', 'QuotationController@previewQuotation');
    Route::any('/quotation/send', 'QuotationController@createQuotation');
    Route::any('/quotation/{id}', 'QuotationController@viewQuotation');
    Route::any('/quotation', 'QuotationController@generateQuotation');

    Route::any('/delivery-note', 'DeliveryNoteController@generateDeliveryNote');
    Route::any('/delivery-note/sent', 'DeliveryNoteController@generateSentDeliveryNote');
    Route::any('/delivery-note/send', 'DeliveryNoteController@sendDeliveryNote');
    Route::any('/delivery-note/{id}', 'DeliveryNoteController@viewDeliveryNote');

    Route::any('/order/{id}', 'OrderController@viewOrder');


    Route::any('/invoice/send', 'InvoiceController@sendInvoice');

    Route::any('/invoice/{id}', 'InvoiceController@viewInvoice');


    Route::any('/payment/{id}', 'PaymentController@viewPayment');

    Route::any('/stocks/get', 'QuotationController@getStocks');

    Route::post('/enquiry/create', 'EnquiryController@create')->name('create_enquiry');


    Route::post('/product/create','ShoppingItemController@createProduct');
    Route::post('/product/update','ShoppingItemController@updateProduct');
    Route::any('/product/get','ShoppingItemController@getItems');
    Route::get('/product/{id}', 'ShoppingItemController@viewProduct');





});


