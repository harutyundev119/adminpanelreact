<?php
// Page Controll
namespace App\Http\Controllers;

use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Deliver;
use App\Group;
use App\HomeSlider;
use App\OneCategory;
use App\PayMethod;
use App\Post;
use App\Reclame;
use App\Returnn;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Category;
use App\Ordering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\OrderingProduct;
use App\QuestionsImage;
use Session;

class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $questions = QuestionsImage::all();
            $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
            $reclames = Reclame::all();
            $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(5)->get();
            $mix_products2 = Product::where('id', '>', 0)->inRandomOrder()->take(5)->get();
            $action_product1s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
            $action_product2s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
            $action_product3s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
            $action_product4s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
            $popular_products = Product::inRandomOrder()->take(3)->get();
            $home_sliders = HomeSlider::all();
            $about_headers = AboutHeader::where('id', 1)->firstOrFail();
            $contact_us = ContactUs::where('id', 1)->firstOrFail();
            $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
            $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
            $one_categories = OneCategory::all();
            $sub_categories = Subcategory::all();
            $groups = Group::all();
            $brands = Brand::all();
            return view('evrika.index')->with([
                'products'=>$products,
                'ordering_products_count'=>$ordering_products_count,
                'about_headers'=> $about_headers,
                'contact_us' => $contact_us,
                'home_sliders' => $home_sliders,
                'popular_products' => $popular_products,
                'mix_products' => $mix_products,
                'mix_products2' => $mix_products2,
                'action_product1s' => $action_product1s,
                'action_product2s' => $action_product2s,
                'action_product3s' => $action_product3s,
                'action_product4s' => $action_product4s,
                'currencies' => $currencies,

                'product_orders' => $product_orders,
                'one_categories'=>$one_categories,
                'sub_categories'=>$sub_categories,
                'groups'=>$groups,
                'brands'=>$brands,

                'sum'=>$sum,
                'p_count' => $p_count,
                'currencys' => $currencys,
                'prod_orders' => $prod_orders,
                'reclames' => $reclames,
                'blog_post' => $blog_post,
                'questions' => $questions,
            ]);
    }
    public function changeCurrency($currencyCode) {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }
    public function deliver() {
        $deliver = Deliver::where('id', 1)->firstOrFail();
        $questions = QuestionsImage::all();
        $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
        $reclames = Reclame::all();
        $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(12)->get();
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $home_sliders = HomeSlider::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.araqum')->with([
            'products'=>$products,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'home_sliders' => $home_sliders,
            'popular_products' => $popular_products,
            'mix_products' => $mix_products,
            'currencies' => $currencies,

            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,

            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
            'blog_post' => $blog_post,
            'questions' => $questions,
            'deliver' => $deliver,
        ]);
    }
    public function return() {
        $return = Returnn::where('id', 1)->firstOrFail();
        $questions = QuestionsImage::all();
        $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
        $reclames = Reclame::all();
        $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(12)->get();
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $home_sliders = HomeSlider::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.return')->with([
            'products'=>$products,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'home_sliders' => $home_sliders,
            'popular_products' => $popular_products,
            'mix_products' => $mix_products,
            'currencies' => $currencies,
            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
            'blog_post' => $blog_post,
            'questions' => $questions,
            'return' => $return,
        ]);
    }
    public function paymentMethod() {
        $pay = PayMethod::where('id', 1)->firstOrFail();
        $questions = QuestionsImage::all();
        $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
        $reclames = Reclame::all();
        $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(12)->get();
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $home_sliders = HomeSlider::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.pay_method')->with([
            'products'=>$products,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'home_sliders' => $home_sliders,
            'popular_products' => $popular_products,
            'mix_products' => $mix_products,
            'currencies' => $currencies,
            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
            'blog_post' => $blog_post,
            'questions' => $questions,
            'pay' => $pay,
        ]);
    }
    public function maps() {
        $cookie_name = "customer";
        $questions = QuestionsImage::all();
        $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
        $reclames = Reclame::all();
        $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(5)->get();
        $mix_products2 = Product::where('id', '>', 0)->inRandomOrder()->take(5)->get();
        $action_product1s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product2s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product3s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product4s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $home_sliders = HomeSlider::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.maps')->with([
            'products'=>$products,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'home_sliders' => $home_sliders,
            'popular_products' => $popular_products,
            'mix_products' => $mix_products,
            'mix_products2' => $mix_products2,
            'action_product1s' => $action_product1s,
            'action_product2s' => $action_product2s,
            'action_product3s' => $action_product3s,
            'action_product4s' => $action_product4s,
            'currencies' => $currencies,
            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
            'blog_post' => $blog_post,
            'questions' => $questions,
        ]);
    }
    public function promo() {
        $questions = QuestionsImage::all();
        $blog_post = Post::orderBy('created_at', 'desc')->take(3)->get();
        $reclames = Reclame::all();
        $promos = Product::where('promo', 1)->paginate(20);
        $mix_products = Product::where('specially_offer', 0)->inRandomOrder()->take(5)->get();
        $mix_products2 = Product::where('id', '>', 0)->inRandomOrder()->take(5)->get();
        $action_product1s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product2s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product3s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $action_product4s = Product::where('price', '>', 0)->inRandomOrder()->take(1)->get();
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $home_sliders = HomeSlider::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->where('specially_offer', 0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
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
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.promo')->with([
            'products'=>$products,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'home_sliders' => $home_sliders,
            'popular_products' => $popular_products,
            'mix_products' => $mix_products,
            'mix_products2' => $mix_products2,
            'action_product1s' => $action_product1s,
            'action_product2s' => $action_product2s,
            'action_product3s' => $action_product3s,
            'action_product4s' => $action_product4s,
            'currencies' => $currencies,
            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
            'blog_post' => $blog_post,
            'questions' => $questions,
            'promos' => $promos,
        ]);
    }
}
