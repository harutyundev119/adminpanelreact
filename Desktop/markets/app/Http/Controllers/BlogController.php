<?php
// Blog page
namespace App\Http\Controllers;

use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\OneCategory;
use App\Post;
use App\Product;
use App\QuestionsImage;
use App\Reclame;
use App\Subcategory;
use Illuminate\Http\Request;
use App\OrderingProduct;
use Session;

class BlogController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reclames = Reclame::all();
        $popular_products = Product::where('specially_offer', 0)->inRandomOrder()->take(6)->get();
        $popular_posts = Post::inRandomOrder()->take(3)->get();
        $blog_images = QuestionsImage::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $posts = Post::paginate(3);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
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
        return view('evrika.blog')->with([
            'ordering_products_count'=>$ordering_products_count,
            'posts' => $posts,
            'about_headers'=> $about_headers,
            'popular_posts' => $popular_posts,
            'blog_images' => $blog_images,
            'contact_us' => $contact_us,
            'popular_products' => $popular_products,

            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'product_orders' => $product_orders,

            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
            'reclames' => $reclames,
        ]);
    }
    public function show($slug) {
        $popular_posts = Post::inRandomOrder()->take(3)->get();
        $blog_images = QuestionsImage::all();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $post = Post::where('slug', $slug)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $product_orders = OrderingProduct::all()->where('session', Session::getId());
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
        return view('evrika.single_blog')->with([
            'ordering_products_count'=>$ordering_products_count,
            'post' => $post,
            'about_headers'=> $about_headers,
            'popular_posts' => $popular_posts,
            'blog_images' => $blog_images,
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
