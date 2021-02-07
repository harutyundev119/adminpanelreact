<?php
// user profile Controll
namespace App\Http\Controllers;


use App\AboutHeader;
use App\Brand;
use App\Category;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\OneCategory;
use App\OrderingProduct;
use App\Ordering;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index() {
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $user = Auth::user();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $categories = Category::where('parent_id',null)->with('children')->get();
        $product_orders = OrderingProduct::all()->where('session', Session::getId());
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        $user_order_products = OrderingProduct::all()->where('user_id', $user->id);
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
        return view('evrika.profile')->with([
            'ordering_products_count'=>$ordering_products_count,
            'user_order_products' => $user_order_products,
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
    public function store(Request $request) {
        $this->validate($request, [
            'name'	=>	'required',
            'phone' => 'required',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
        ]);
        $user = Auth::user();
        $user->edit($request->all());
        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }
}
