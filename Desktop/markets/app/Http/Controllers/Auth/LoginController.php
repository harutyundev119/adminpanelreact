<?php

namespace App\Http\Controllers\Auth;

use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\Http\Controllers\Controller;
use App\OneCategory;
use App\Product;
use App\Providers\RouteServiceProvider;
use App\Subcategory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\OrderingProduct;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();

        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();

        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currencys = Currency::where('code', $currencies_val)->first();

        $sum = 0;
        $p_count = 0;
        $id_product_orders = [];

        $product_orders = OrderingProduct::all()->where('session', Session::getId());
        foreach ($product_orders as $product){
            $sum = $sum+($product->product_price*$product->quantity);
            $p_count = $p_count+($product->quantity);
        }

        foreach ($product_orders as $product_order){
            array_push( $id_product_orders, $product_order->product_id);
        }
        $prod_orders = Product::whereIn('id', $id_product_orders)->get();

        return view('auth.login')->with([
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,

            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,

            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);
    }
}
