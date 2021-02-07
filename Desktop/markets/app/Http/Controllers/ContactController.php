<?php
// Contact page
namespace App\Http\Controllers;

use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\OneCategory;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use App\OrderingProduct;
use Session;
use App\Message;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;


class ContactController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
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
        return view('evrika.contact')->with([
            'ordering_products_count' => $ordering_products_count,
            'about_headers' => $about_headers,
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
    public function message(Request $request){
        $this->validate($request, [
            'name'	=>	'required|max:50',
            'email' =>  'required|email',
            'message'	=>	'required',
        ]);
        $data = $request->all();
        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone ? $request->phone : "";
        $message->subject = $request->subject ? $request->subject : '';
        $message->message = $request->message;
        if($message->save()) {
            return redirect()->back();
        }
    }
}
