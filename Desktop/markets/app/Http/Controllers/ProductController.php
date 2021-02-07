<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.04.2020
 * Time: 19:50
 */
// Product show and Controll
namespace App\Http\Controllers;
use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\OneCategory;
use App\Subcategory;
use App\Translation;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Ordering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\OrderingProduct;
use Session;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function product($id){
        $all_prod = Product::where('id', $id)->first();
        $all_prod_cats = Product::where('category', $all_prod->category)->inRandomOrder()->where('specially_offer', 0)->take(6)->get()->except($id);
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $product = Product::where('id', $id)->first();
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
        foreach ($product_orders as $product_ord){
            $sum = $sum+($product_ord->product_price*$product_ord->quantity);
            $p_count = $p_count+($product_ord->quantity);
        }
        foreach ($product_orders as $product_order){
            array_push( $id_product_orders, $product_order->product_id);
        }
        $prod_orders = Product::whereIn('id', $id_product_orders)->get();
        $categories = Category::where('parent_id',null)->with('children')->get();
        return view('evrika.sigle_product')->with([
            'product'=>$product,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'all_prod_cats' => $all_prod_cats,
            'currencies' => $currencies,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'product_orders'=>$product_orders,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);
    }
    public function product_category($id){
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $products = Product::where('category',$id)->paginate(9);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $categories = Category::where('parent_id',null)->with('children')->get();
        return view('evrika.product_category')->with([
            'products'=>$products,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'popular_products' => $popular_products,
        ]);
    }
    public function product_add(Request $request){
        var_dump($request->all());exit;
    }
    public function search(Request $request) {
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $categories = Category::where('parent_id',null)->with('children')->get();
        if(strlen($request->get('search')) > 1) {
            $search = $request->get('search');
        } else {
            $search = '%&^';
        }
        $product_notranslate = Product::where('name' , 'like', '%'.$search.'%')->where('specially_offer', 0)->get();
        $prod_trans = Translation::where('table_name', 'products')->where('column_name', 'name')->where('value', 'like', '%'.$search.'%')->get();
        $prod_search = [];
        foreach($prod_trans as $prod_tran) {
            array_push($prod_search, $prod_tran->foreign_key);
        }
        $prod_translate = Product::whereIn('id', $prod_search)->where('specially_offer', 0)->get();
        $currencies_val = session('currency', 'AMD');
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
        foreach ($product_orders as $product_ord){
            $sum = $sum+($product_ord->product_price*$product_ord->quantity);
            $p_count = $p_count+($product_ord->quantity);
        }
        foreach ($product_orders as $product_order){
            array_push( $id_product_orders, $product_order->product_id);
        }
        $prod_orders = Product::whereIn('id', $id_product_orders)->get();
        if($product_notranslate->isEmpty() && $prod_translate->isEmpty()) {
            return back()->with('status', 'По вашему запросу ничего не найдено');
        } else {
            return view('evrika.search')->with([
                'product_notranslate' => $product_notranslate,
                'prod_translate' => $prod_translate,
                'categories'=>$categories,
                'ordering_products_count'=>$ordering_products_count,
                'about_headers'=> $about_headers,
                'contact_us' => $contact_us,
                'popular_products' => $popular_products,
                'search' => $search,
                'one_categories'=>$one_categories,
                'sub_categories'=>$sub_categories,
                'groups'=>$groups,
                'brands'=>$brands,
                'product_orders'=>$product_orders,
                'currencys' => $currencys,
                'sum'=>$sum,
                'p_count' => $p_count,
                'prod_orders' => $prod_orders,
            ]);
        }
    }

    public function delete_ordered_product(Request $request){

        $roduct_delete = OrderingProduct::where('id',$request->ordered_product)->delete();
        if($roduct_delete){
            echo $request->ordered_product;exit;
        }
    }

    public function product_category_id($id){
        $categories = Category::all()->where('parent_id',$id);
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();

        $products = Product::where(function ($query ) use ($categories) {
            foreach($categories as $category) {

                $query->orWhere('category',$category->id);
            }
        })->paginate(20);
        $categories = Category::where('parent_id',null)->with('children')->get();
        return view('evrika.products_parentcategory')->with([
            'products'=>$products,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'popular_products' => $popular_products,
        ]);

    }

    public function categories($slug) {
        $category_id = OneCategory::where('slug', $slug)->first();
        $subcategories = Subcategory::where('category_id', $category_id->id)->get();

        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currency = Currency::where('code', $currencies_val)->first();
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

        return view('evrika.categories')->with([
            'contact_us' => $contact_us,
            'ordering_products_count'=>$ordering_products_count,
            'product_orders' => $product_orders,
            'currencies' => $currencies,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'subcategories' => $subcategories,
            'category_id' => $category_id,

            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);
    }
    public function subcategories($category_slug, $subcategory_slug) {
        $category_id = OneCategory::where('slug', $category_slug)->first();
        $subcategory_id = Subcategory::where('slug', $subcategory_slug)->first();
        $cats_way = [];
        $category_way = Category::where('category', $category_id->id)->where('sub_category', $subcategory_id->id)->get();
        foreach ($category_way as $cat_way) {
            array_push( $cats_way, $cat_way->id);
        }
        $products_all = Product::whereIn('category', $cats_way)->where('specially_offer', 0)->paginate(20);
        $groupies = Group::where('subcategory_id', $subcategory_id->id)->get();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currency = Currency::where('code', $currencies_val)->first();
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
        return view('evrika.subcategories')->with([
            'contact_us' => $contact_us,
            'ordering_products_count'=>$ordering_products_count,
            'product_orders' => $product_orders,
            'currencies' => $currencies,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'subcategory_id' => $subcategory_id,
            'category_id' => $category_id,
            'products_all' => $products_all,
            'groupies' =>  $groupies,

            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);

    }
    public function groups($category_slug, $subcategory_slug, $group_slug) {
        $category_id = OneCategory::where('slug', $category_slug)->first();
        $subcategory_id = Subcategory::where('slug', $subcategory_slug)->first();
        $groupes_id = Group::where('slug', $group_slug)->first();
        $category_way = Category::where('category', $category_id->id)->where('sub_category', $subcategory_id->id)->where('group', $groupes_id->id)->first();
        $groupies = Group::where('subcategory_id', $subcategory_id->id)->get();
        if(empty($category_way)) {
            $products_all = '';
        } else {
            $products_all = Product::where('category', $category_way->id)->where('specially_offer', 0)->paginate(20);
        }
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $product_orders = OrderingProduct::all()->where('session', Session::getId());
        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currency = Currency::where('code', $currencies_val)->first();
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
        if(empty($category_way)) {
            return redirect()->back()->with('status', 'Ոչինչ չի գտնվել');
        } else {
            return view('evrika.group')->with([
                'contact_us' => $contact_us,
                'ordering_products_count'=>$ordering_products_count,
                'product_orders' => $product_orders,
                'currencies' => $currencies,
                'currency' => $currency,
                'one_categories'=>$one_categories,
                'sub_categories'=>$sub_categories,
                'groups'=>$groups,
                'brands'=>$brands,
                'category_id' =>  $category_id,
                'groupes_id' =>  $groupes_id,
                'subcategory_id' => $subcategory_id,
                'products_all' => $products_all,
                'groupies' =>  $groupies,
                'sum'=>$sum,
                'p_count' => $p_count,
                'currencys' => $currencys,
                'prod_orders' => $prod_orders,
            ]);
        }
    }
    public function subcatprod($category_slug, $subcategory_slug, $id) {
        $all_prod = Product::where('id', $id)->first();
        $all_prod_cats = Product::where('category', $all_prod->category)->inRandomOrder()->take(6)->get()->except($id);
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $product = Product::where('id',$id)->first();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $currencies_val = session('currency', 'AMD');
        $currency = Currency::where('code', $currencies_val)->first();
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
        foreach ($product_orders as $product_ord){
            $sum = $sum+($product_ord->product_price*$product_ord->quantity);
            $p_count = $p_count+($product_ord->quantity);
        }
        foreach ($product_orders as $product_order){
            array_push( $id_product_orders, $product_order->product_id);
        }
        $prod_orders = Product::whereIn('id', $id_product_orders)->get();
        $categories = Category::where('parent_id',null)->with('children')->get();
        return view('evrika.sigle_product')->with([
            'product'=>$product,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'all_prod_cats' => $all_prod_cats,
            'currencies' => $currencies,
            'currency' => $currency,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'product_orders'=>$product_orders,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);
    }
    public function grouporod($category_slug, $subcategory_slug, $group_slug, $id) {
        $all_prod = Product::where('id', $id)->first();
        $all_prod_cats = Product::where('category', $all_prod->category)->inRandomOrder()->take(6)->get()->except($id);
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $product = Product::where('id',$id)->first();
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
        foreach ($product_orders as $product_ord){
            $sum = $sum+($product_ord->product_price*$product_ord->quantity);
            $p_count = $p_count+($product_ord->quantity);
        }
        foreach ($product_orders as $product_order){
            array_push( $id_product_orders, $product_order->product_id);
        }
        $prod_orders = Product::whereIn('id', $id_product_orders)->get();
        $categories = Category::where('parent_id',null)->with('children')->get();
        return view('evrika.sigle_product')->with([
            'product'=>$product,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'all_prod_cats' => $all_prod_cats,
            'currencies' => $currencies,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
            'product_orders'=>$product_orders,
            'sum'=>$sum,
            'p_count' => $p_count,
            'currencys' => $currencys,
            'prod_orders' => $prod_orders,
        ]);
    }
}
