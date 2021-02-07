<?php
// About Page
namespace App\Http\Controllers;

use App\AboutAvard;
use App\AboutExperience;
use App\AboutHeader;
use App\AboutService;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Faquestion;
use App\Group;
use App\OneCategory;
use App\Product;
use App\QuestionsImage;
use App\Subcategory;
use Illuminate\Http\Request;
use App\OrderingProduct;
use Session;


class AboutController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $about_headers = AboutHeader::where('id',1)->first();
        $about_services = AboutService::all();
        $about_faquestions = Faquestion::all();
        $about_avards = AboutAvard::all();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        // menu info
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        $currencies = Currency::get();
        // exchange rate
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
        return view('evrika.about')->with([
            'ordering_products_count'=>$ordering_products_count,
            'about_headers' => $about_headers,
            'about_services' => $about_services,
            'about_faquestions' => $about_faquestions,
            'about_avards' => $about_avards,
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
