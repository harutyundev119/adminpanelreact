<?php

use Illuminate\Support\Facades\Route;

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


//Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();

    Route::get('/products_in_order/{id}', 'Voyager\VoyagerOrderProductsController@orderingProducts');
    Route::get('/nocash_orderings', 'Voyager\VoyagerCashProductsController@nocashProducts');
    Route::get('/cash_orderings', 'Voyager\VoyagerCashProductsController@cashProducts');
    Route::post('/order_add_paid', 'Voyager\VoyagerCashProductsController@order_add_paid');



});


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'IndexController@index')->name('home');

    Auth::routes();

    Route::post('/currency_update', 'CurrencyUpdateController@currencyUpdate')->name('currency_update');

    Route::any('/idram_paymant_fail', 'PaymentController@idram_paymant_fail');

    Route::any('/idram_payment_success', 'PaymentController@idram_payment_success');

    Route::post('/idram_paymant_result', 'PaymentController@idram_paymant_result');

    Route::get('/ameria_payment_success', 'PaymentController@ameria_payment_success');

    Route::get('/success', 'PaymentController@successallpay')->name('successallpay');

    Route::get('/nosuccess', 'PaymentController@nosuccessallpay')->name('nosuccessallpay');

    Route::get('/auth/{provider}', 'Auth\RegisterController@redirectToProvider');
    Route::get('/auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

    Route::get('/currency/{currencyCode}', 'IndexController@changeCurrency')->name('currency');

    Route::get('/about', 'AboutController@index')->name('about');

    Route::get('/deliver', 'IndexController@deliver')->name('deliver');

    Route::get('/return', 'IndexController@return')->name('return');

    Route::get('/payment-method', 'IndexController@paymentMethod')->name('payment-method');

    Route::get('/service', 'ServiceController@index')->name('service');

    Route::get('/blog', 'BlogController@index')->name('blog');

    Route::get('/maps', 'IndexController@maps')->name('maps');

    Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

    Route::get('/shop', 'ShopController@index')->name('shop');

    Route::post('/shop_cart', 'ShopController@shop_cart')->name('shop_cart');

    Route::post('/singl_shop_cart', 'ShopController@singl_shop_cart')->name('singl_shop_cart');

    Route::get('/action', 'ShopController@action')->name('action');

    Route::get('/contact', 'ContactController@index')->name('contact');

    Route::post('/contact', 'ContactController@message')->name('contact_post');

    Route::get('/search', 'ProductController@search');

    Route::get('/promo', 'IndexController@promo')->name('promo');

    Route::get('/profile', 'MyProfileController@index')->name('profile');

    Route::post('/profile', 'MyProfileController@store');

    Route::get('/product_order', 'ShopController@product_order')->name('product_order');

    Route::post('/ordering', 'ShopController@ordering');

    Route::get('/ordering_cart', 'ShopController@ordering_cart')->name('ordering_cart');

    Route::get('/product/{id}', 'ProductController@product');

    Route::get('/products/{id}', 'ProductController@product_category')->name('products_category');

    Route::get('/{categories}/', 'ProductController@categories')->name('categories');

    Route::get('/{categories}/{subcategories}/', 'ProductController@subcategories')->name('subcategories');

    Route::get('/{categories}/{subcategories}/{group}', 'ProductController@groups')->name('groups');

    Route::get('/{categories}/{subcategories}/product/{id}', 'ProductController@subcatprod')->name('subcatprod');

    Route::get('/{categories}/{subcategories}/{group}/{id}', 'ProductController@grouporod')->name('grouporod');

    Route::post('/product-add/{id}', 'ProductController@product_add');

    Route::post('/shop_cart_quantity', 'ShopController@shop_cart_quantity');

    Route::post('/delete_ordered_product', 'ProductController@delete_ordered_product');

    Route::get('/telcel_test', 'TelcelController@index');

    Route::get('/product/category/{id}', 'ProductController@product_category_id')->name('product.category.id');


});
