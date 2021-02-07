<?php
// Currency and basket
namespace App\Http\Controllers;

use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\Mail\PaymentsMail;
use App\OneCategory;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Ordering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\OrderingProduct;
use Session;
use App\Araqum;
use Mail;

class ShopController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popular_products = Product::inRandomOrder()->take(3)->get();
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $products = Product::where('id','>',0)->paginate(18);
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $categories = Category::where('parent_id',null)->with('children')->get();
        $product_orders = OrderingProduct::all()->where('session', Session::getId());
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
        return view('evrika.shop')->with([
            'products'=>$products,
            'categories'=>$categories,
            'ordering_products_count'=>$ordering_products_count,
            'about_headers'=> $about_headers,
            'contact_us' => $contact_us,
            'popular_products' => $popular_products,
            'product_orders' => $product_orders,
            'one_categories'=>$one_categories,
            'sub_categories'=>$sub_categories,
            'groups'=>$groups,
            'brands'=>$brands,
        ]);
    }
    public function shop_cart(Request $request){
        $product_id = $request->product_id;
        $product_count = OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->count();
        if($currencies = session('currency') != null) {
            $currencies = session('currency');
        } else {
            $currencies = "AMD";
        }
        if($product_count == "0"){
            $ordering_product = new OrderingProduct();
            $product_id = $request->product_id;
            $ordering_product->product_id =  $product_id ;
            $ordering_product->order_id =  null ;
            $ordering_product->product_name =  $request->product_name ;
            $ordering_product->image =  $request->product_image  ;
            $ordering_product->quantity =  $request->product_count ;
            $prod_price = Product::where('id', $product_id)->first();
            if($prod_price->prod_type == "kilo") {
                $prod_isset = "2";
            } elseif($prod_price->prod_type == "litr") {
                $prod_isset = "3";
            } elseif($prod_price->prod_type == "tup") {
                $prod_isset = "1";
            }
            $ordering_product->isset = $prod_isset;
            if($currencies == "AMD") {
                $ordering_product->product_price =  $request->product_price;
            }
            if($currencies == "RUB") {
                $rub =  Currency::where('code', $currencies)->first();
                if($prod_price->action_price != null)  {
                    $ordering_product->product_price = $prod_price->action_price;
                } else {
                    $ordering_product->product_price = $request->product_price * $rub->rate;
                }
            }
            if($currencies == "USD"){
                $usd =  Currency::where('code', $currencies)->first();
                if($prod_price->action_price != null) {
                    $ordering_product->product_price = $prod_price->action_price;
                } else {
                    $ordering_product->product_price = $request->product_price * $usd->rate;
                }
            }
            if(Auth::user() != null ){
                $ordering_product->user_id = Auth::id();
            }
            $ordering_product->session =  Session::getId();

            if($ordering_product->save()){
                echo $ordering_product->id;
                exit;
            }
        } else {
            $prod_price = Product::where('id', $product_id)->first();

            if($prod_price->prod_type == "kilo") {
                $prod_isset = "2";
            } elseif($prod_price->prod_type == "litr") {
                $prod_isset = "3";
            } elseif($prod_price->prod_type == "tup") {
                $prod_isset = "1";
            }
            $product = OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->first();
            $quantity = $product->quantity ;
            $add = $quantity + $request->product_count;
            OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->where('isset', $prod_isset)->update(['quantity' => $add]);
        }
    }
    public function singl_shop_cart(Request $request){
        $product_id = $request->product_id;
        $isset_price =  $request->product_price;
        $product_count = OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->where('isset', $isset_price)->count();
        if($currencies = session('currency') != null) {
            $currencies = session('currency');
        } else {
            $currencies = "AMD";
        }
        if($product_count == "0"){
            $ordering_product = new OrderingProduct();
            $product_id = $request->product_id;
            $ordering_product->product_id =  $product_id ;
            $ordering_product->order_id =  null ;
            $ordering_product->product_name =  $request->product_name ;
            $ordering_product->image =  $request->product_image  ;
            $ordering_product->quantity =  1 ;
            $amd = Currency::where('code', "AMD")->first();
            $rub = Currency::where('code', "RUB")->first();
            $usd = Currency::where('code', "USD")->first();
            $prod_price = Product::where('id', $product_id)->first();
            $ordering_product->isset = $request->product_price;
            if($request->product_price == "1") {
                if($prod_price->action_price != null) {
                    $ordering_product->product_price = $prod_price->action_price;
                } else  {
                    if($currencies == "AMD") {
                        $ordering_product->product_price = $prod_price->price * $amd->rate;
                    }
                    if($currencies == "RUB") {
                        $ordering_product->product_price = $prod_price->price * $rub->rate;
                    }
                    if($currencies == "USD") {
                        $ordering_product->product_price = $prod_price->price * $usd->rate;
                    }
                }
            } elseif($request->product_price == "11") {
                $ordering_product->product_price = $prod_price->hatavachar;
            }
            if($request->product_price == "2") {
                if($prod_price->action_price != null) {
                    $ordering_product->product_price = $prod_price->action_price;
                } else {
                    if($currencies == "AMD") {
                        $ordering_product->product_price = $prod_price->price * $amd->rate;
                    }
                    if($currencies == "RUB") {
                        $ordering_product->product_price = $prod_price->price * $rub->rate;
                    }
                    if($currencies == "USD") {
                        $ordering_product->product_price = $prod_price->price * $usd->rate;
                    }
                }
            } elseif($request->product_price == "22") {
                $ordering_product->product_price = $prod_price->gram;
            }
            if($request->product_price == "3") {
                if($prod_price->action_price != null) {
                    $ordering_product->product_price = $prod_price->action_price;
                } else {
                    if($currencies == "AMD") {
                        $ordering_product->product_price = $prod_price->price * $amd->rate;
                    }
                    if($currencies == "RUB") {
                        $ordering_product->product_price = $prod_price->price * $rub->rate;
                    }
                    if($currencies == "USD") {
                        $ordering_product->product_price = $prod_price->price * $usd->rate;
                    }
                }
            } elseif($request->product_price == "33") {
                $ordering_product->product_price = $prod_price->litr;
            }
            if(Auth::user() != null ){
                $ordering_product->user_id = Auth::id();
            }
            $ordering_product->session =  Session::getId();

            if($ordering_product->save()){
                echo 'success';
                exit;
            }
        } else {
            $product = OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->where('isset', $isset_price)->first();
            $quantity = $product->quantity ;
            $add = $quantity + 1;
            OrderingProduct::where('session', Session::getId())->where('product_id', $product_id)->where('isset', $request->product_price)->update(['quantity' => $add]);
        }
    }
    public function product_order(){
        $contact_us = ContactUs::where('id', 1)->firstOrFail();
        $about_headers = AboutHeader::where('id', 1)->firstOrFail();
        $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currencys = Currency::where('code', $currencies_val)->first();
        $one_categories = OneCategory::all();
        $sub_categories = Subcategory::all();
        $groups = Group::all();
        $brands = Brand::all();
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
        if(count($product_orders) < 1) {
            return redirect()->back()->with('status', 'Ձեր զամբյուղը դատարկե է');
        } else {
            return view('evrika.product_order')->with([
                'product_orders'=>$product_orders,
                'ordering_products_count'=>$ordering_products_count,
                'about_headers'=> $about_headers,
                'contact_us' => $contact_us,
                'currencies' => $currencies,
                'currencys' => $currencys,
                'one_categories'=>$one_categories,
                'sub_categories'=>$sub_categories,
                'groups'=>$groups,
                'brands'=>$brands,

                'sum'=>$sum,
                'p_count' => $p_count,
                'prod_orders' => $prod_orders,
            ]);
        }
    }
    public function shop_cart_quantity(Request $request){
        $currencies = Currency::get();
        $currencies_val = session('currency', 'AMD');
        $currencys = Currency::where('code', $currencies_val)->first();

        if(OrderingProduct::where('id', $request->id)
            ->update(['quantity' => $request->quantity])){
            echo $currencys->symbol;exit;
    }else{
        echo $currencys->symbol;exit;
    }
}
public function action() {
    $contact_us = ContactUs::where('id', 1)->firstOrFail();
    $ordering_products_count = OrderingProduct::all()->where('session', Session::getId())->count();
    $action_products = Product::where('action_price',  '>', 0)->where('specially_offer', 0)->paginate(12);
    $currencies_val = session('currency', 'AMD');
    $currency = Currency::where('code', $currencies_val)->first();
    $one_categories = OneCategory::all();
    $sub_categories = Subcategory::all();
    $groups = Group::all();
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
    return view('evrika.action')->with([
        'ordering_products_count'=>$ordering_products_count,
        'product_orders'=>$product_orders,
        'contact_us' => $contact_us,
        'action_products' => $action_products,
        'currencies' => $currencies,
        'currency' => $currency,
        'one_categories'=>$one_categories,
        'sub_categories'=>$sub_categories,
        'groups'=>$groups,
        'sum'=>$sum,
        'p_count' => $p_count,
        'currencys' => $currencys,
        'prod_orders' => $prod_orders,
    ]);
}
public function ordering_cart(){
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
    foreach ($product_orders as $product_ord){
        $sum = $sum+($product_ord->product_price*$product_ord->quantity);
        $p_count = $p_count+($product_ord->quantity);
    }
    foreach ($product_orders as $product_order){
        array_push( $id_product_orders, $product_order->product_id);
    }
    $prod_orders = Product::whereIn('id', $id_product_orders)->get();
    $araqum_sum = Araqum::where('id',1)->first();
    $araqum_sum = $araqum_sum->price / $currencys->rate;
    return view('evrika.ordering_cart')->with([
        'ordering_products_count'=>$ordering_products_count,
        'product_orders'=>$product_orders,
        'about_headers'=> $about_headers,
        'contact_us' => $contact_us,
        'araqum_sum' => $araqum_sum,
        'currencies' => $currencies,
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
public function ordering(Request $request){
    if($request->pay == "non_cash"){
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);
    }else{
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'payment_type' => 'required',
            'pay' => 'required',
        ]);
    }
    $order_id = uniqid(true);
    $ordering = new Ordering();
    $isset_ordering = Ordering::where('session', Session::getId())->first();
    if($isset_ordering){
        $isset_ordering->email = $request->email;
        $isset_ordering->customer_addres = $request->address;
        $isset_ordering->customer_telephone = $request->phone;
        $isset_ordering->amount = $request->sum;
        $isset_ordering->user_id =(Auth::user() != null) ? Auth::user()->id : null;
        if($request->pay == "non_cash"){
            $isset_ordering->show = 1;
            $isset_ordering->cash = 1;
            $isset_ordering->all_session = Session::getId();
            if($isset_ordering->save()){
                $sesion = $isset_ordering->session;
                $product_orders = OrderingProduct::all()->where('session',$sesion);
                if(isset($product_orders)){
                    foreach ($product_orders as $product_order){
                        OrderingProduct::where('id', $product_order->id)->update([
                            'session' => 1,
                            'order_id' => $isset_ordering->order_id,
                        ]);
                    }
                }
                $order_full = $this->orderfullend();
                Mail::send(new PaymentsMail($order_full));
                return redirect()->route('successallpay');exit;
            }
        }
        if($isset_ordering->save()){
            $array = array(
                "Amount" => $request->sum,
                "Language" => app()->getLocale(),
                "OrderID" => $isset_ordering->order_id,
                "Description" => "paymant test",
                "Currency" => "AMD",
            );
            if($request->payment_type == 'idram'){

                return view('evrika.payment.idbank')->with(['array'=>$array]);
            }elseif ($request->payment_type == 'telcell'){
                return view('evrika.payment.telcel')->with(['order_id'=>$order_id]);
            }elseif($request->payment_type == 'ameria'){
                $this->ameria_payment($array);
            }
        }
    }else{
        $ordering->order_id = $order_id;
        $ordering->email = $request->email;
        $ordering->customer_addres = $request->address;
        $ordering->customer_telephone = $request->phone;
        $ordering->customer_city = $request->city;
        $ordering->amount = $request->sum;
        $ordering->user_id =(Auth::user() != null) ? Auth::user()->id : null;
        $ordering->session =Session::getId();
        if((Auth::user()!=null)){
            $ordering->user_id = Auth::id();
        }
        if($request->pay == "non_cash"){
            $ordering->show = 1;
            $ordering->cash = 1;
            $ordering->all_session = Session::getId();
            if($ordering->save()){
                $sesion = $ordering->session;
                $product_orders = OrderingProduct::all()->where('session',$sesion);
                if(isset($product_orders)){
                    foreach ($product_orders as $product_order){
                        OrderingProduct::where('id', $product_order->id)->update([
                            'session' => 1,
                            'order_id' => $ordering->order_id,
                        ]);
                    }
                    $ordering->session = 1;
                    $ordering->save();
                }
                $order_full = $this->orderfullend();
                Mail::send(new PaymentsMail($order_full));
                return redirect()->route('successallpay');exit;
            }
        }
        if($ordering->save()){
            $array = array(
                "Amount" => $request->sum,
                "Language" => app()->getLocale(),
                "OrderID" => $order_id,
                "Description" => "paymant test",
                "Currency" => "AMD",
            );
            if($request->payment_type == 'idram'){
                return view('evrika.payment.idbank')->with(['array'=>$array]);
            }elseif ($request->payment_type == 'telcell'){
                return view('evrika.payment.telcel')->with(['order_id'=>$order_id]);
            }elseif($request->payment_type == 'ameria'){
                $this->ameria_payment($array);
            }
        }

    }
}
public function payment_success(Request $request){
    var_dump($request->all());exit;
}
public function ameria_payment($array){
    $clientID = "c0a7031d-b864-4891-992d-8b4c4fc3bf9c";
    $username = "3d19541048";
    $password = "lazY2k";
    $headers = [
        'Content-Type:application/json',
    ];
    $array["ClientID"] = $clientID;
    $array["Username"] = $username;
    $array["Password"] = $password;
    $array["Currency"] = "051";
    $array["Description"] = "Product payment";
    $array["BackURL"] = "https://evrika.am/ameria_payment_success";
    $array["OrderID"] = $array["OrderID"] ;
    $postData = json_encode($array,JSON_PRESERVE_ZERO_FRACTION);
    $url = "https://servicestest.ameriabank.am/VPOS/api/VPOS/InitPayment";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS,  $postData);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($curl);
    curl_close($curl);
    $result_json_decoded = json_decode($result);
    if ($result_json_decoded->ResponseCode !== 1) {
        echo 'Error processing checkout. Please contact administrator.';
        return false;
    }
    if ($result) {
        $result = json_decode($result);
    }else{
        echo 'Error processing checkout. Please contact administrator.';
        return false;
    }
    $paymantId = $result->ResponseCode==1 ? $result->PaymentID : false;
    if ($result->ResponseCode==1 && $result->PaymentID) {
        $this->proceedPayment($result->PaymentID);
    }
}
public function proceedPayment($paymentId)
{
    if ($paymentId) {
        $paymentQuery = [
            'id'   => $paymentId,
            'lang' => "en",
        ];
        $query = urldecode(http_build_query($paymentQuery));
        $redirect_url = "https://servicestest.ameriabank.am/VPOS/Payments/Pay?".$query;
        header("Location: $redirect_url");
        exit;
    } else {
        var_dump('error');exit;
    }
}
public function idram_payment($array){
    return redirect()->route('login');
    return View::make('evrika.payment.idbank')->with(['array'=>$array]);
}
public function telcel_form($order_id){
    $shop_key = "LEnGy<Hp!s*|n_T!7f{5O]QfTKGod2^gN{O(aBXFchE?ahZPQvSMI6Yq|-z>i9rt[$^HkdWPty?8Oq^ZEb=-i8pxlhdLq7OFZgXBc%IBD>KuYJ[eC{zl3DU1vPuTa9qL";
    $shop_id = $order_id;
    $sum = number_format(1, 2, '.', '');
    $desc = "Telcel paymant". $order_id;
    $currency = "AMD";
    $cur_locale = 'en';
    $locale = 'en';
    $signature = md5($shop_key.
        $shop_id.
        '֏'.
        $sum.
        base64_encode($desc).
        base64_encode($order_id).
        '1'
    );
    return
    '<form target="_blank" action="https://telcellmoney.am/invoices" method="POST" id="telcell_form">'
    . '<input type="hidden" name="action" value="PostInvoice"/>'
    . '<input type="hidden" name="issuer" value="'. $shop_id .'"/>'
    . '<input type="hidden" name="currency" value="֏"/>'
    . '<input type="hidden" name="price" value="'. $sum .'"/>'
    . '<input type="hidden" name="product" value="'. base64_encode($desc) .'"/>'
    . '<input type="hidden" name="issuer_id" value="'. base64_encode($order_id) .'"/>'
    . '<input type="hidden" name="valid_days" value="1"/>'
    . '<input type="hidden" name="security_code" value="'. $signature .'"/>'
    . '<input type="submit" value="Pay telcell"/>'
    . '<a class="button cancel" href="/">Cancel payment and return back to card</a>'
    . '</form>';
}
protected function orderfullend() {
    $order_full = Ordering::where('all_session', Session::getId())->where('show', 1)->first();
    return $order_full;
}
}
