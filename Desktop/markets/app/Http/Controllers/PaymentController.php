<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.04.2020
 * Time: 14:52
 */
// shop payment system telcell visa 
namespace App\Http\Controllers;
use App\AboutHeader;
use App\Brand;
use App\ContactUs;
use App\Currency;
use App\Group;
use App\HomeSlider;
use App\Mail\PaymentsMail;
use App\OneCategory;
use App\Post;
use App\QuestionsImage;
use App\Reclame;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Category;
use App\Ordering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\OrderingProduct;
use Session;
use Mail;


class PaymentController extends Controller
{
    public function idram_payment_success(Request $request){
        $paymenment_order = Ordering::where('order_id', $_REQUEST['EDP_BILL_NO'])->first();
        if(isset($paymenment_order)){
            $paymenment_order->update([
                'order_status' => 1,
            ]);
        }
        $sesion = $paymenment_order->session;
        $product_orders = OrderingProduct::all()->where('session',$sesion);

        if(isset($product_orders)){
            foreach ($product_orders as $product_order){
                OrderingProduct::where('id', $product_order->id)->update([
                    'session' => 1,
                    'order_id' => $_REQUEST['EDP_BILL_NO'],
                ]);
            }
        }
        $order_full = $this->orderfullend();
        Mail::send(new PaymentsMail($order_full));
        return redirect()->route('successallpay');exit;
    }
    public function idram_paymant_fail(Request $request){
        return redirect()->route('nosuccessallpay');
    }
    public function idram_paymant_result(Request $request){
    $SECRET_KEY = "8nAYQyVEkPA2bzn8B3n7UBaNtuZsD4mjXdZqQj";
        $EDP_REC_ACCOUNT = "110000339";
        if(isset($_REQUEST['EDP_PRECHECK']) && isset($_REQUEST['EDP_BILL_NO']) && isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT'])) {
            if($_REQUEST['EDP_PRECHECK'] == "YES") {
                if($_REQUEST['EDP_REC_ACCOUNT'] == $EDP_REC_ACCOUNT) {
                    $bill_no = $_REQUEST['EDP_BILL_NO'];
                    $req_amount = $_REQUEST['EDP_AMOUNT'];
                    $orderid = Ordering::where('order_id',$bill_no)->first();
                    if($orderid['order_id'] == $bill_no  && $req_amount == $orderid['amount']){
                        echo "ok";
                    }
                }
            }
        }
        if(isset($_REQUEST['EDP_PAYER_ACCOUNT']) && isset($_REQUEST['EDP_BILL_NO']) && isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT']) && isset($_REQUEST['EDP_TRANS_ID']) && isset($_REQUEST['EDP_CHECKSUM'])) {
            $txtToHash =  $EDP_REC_ACCOUNT . ":" . $_REQUEST['EDP_AMOUNT'] . ":" . $SECRET_KEY . ":" . $_REQUEST['EDP_BILL_NO'] . ":" . $_REQUEST['EDP_PAYER_ACCOUNT'] . ":" . $_REQUEST['EDP_TRANS_ID'] . ":" . $_REQUEST['EDP_TRANS_DATE'];
            if(strtoupper($_REQUEST['EDP_CHECKSUM']) != strtoupper(md5($txtToHash))) {
                return false;
            } else {
                echo("OK");
            }
        }
    }
    public function idram_paymant($data){
        return view('evrika.payment.idbank')->with(['array'=>$data]);
    }
    public function pay_ok(){
        $pay = 1;
        if($pay == 1){
            $paymenment_order = Ordering::where('order_id', '15ea5d2022e32c')->first();
            if(isset($paymenment_order)){
                $paymenment_order->update([
                    'order_status' => 1,
                ]);
            }
            $sesion = $paymenment_order->session;
            $product_orders = OrderingProduct::all()->where('session',$sesion);
            if(isset($product_orders)){
                foreach ($product_orders as $product_order){
                    OrderingProduct::where('id', $product_order->id)->update([
                        'session' => 1,
                    ]);
                }
            }
            $order_full = $this->orderfullend();
            Mail::send(new PaymentsMail($order_full));
            return redirect()->route('successallpay');exit;
        }

    }
    public function telsel_payment_test(){
        $issues = '02690198@shop.telcell.am';
        $key = 'hMfnXE8v|3&GOpc@x_6tC5cT}7mDJC2WmL*x-^d+W{RfD+~}lfcai#A@.4Cxa|VN2!oD^3ZrGMxS))Pn';
        $buyer = '454545';
        $currency = "AMD";
        $sum = "10";
        $description = "telsel pay";
        $valid_days = 1;
        $issuer_id = 1;
        $url_issuer_id = urlencode(base64_encode("Test"));
        var_dump($url_issuer_id);
        $checksum =  md5($key.$issues.$buyer.$currency.$sum.$description.$valid_days.$issuer_id);
    }

    public function ameria_payment_success(Request $request){
        $resposneCode = $_REQUEST['resposneCode'];
          if($resposneCode === "00"){
          $paymenment_order = Ordering::where('order_id', $_REQUEST['orderID'])->first();
            if(isset($paymenment_order)){
                $paymenment_order->update([
                    'order_status' => 1,
                    'payment_id' => $_REQUEST['paymentID']
                ]);
            }
            $sesion = $paymenment_order->session;
            $product_orders = OrderingProduct::all()->where('session',$sesion);
            if(isset($product_orders)){
                foreach ($product_orders as $product_order){
                    OrderingProduct::where('id', $product_order->id)->update([
                        'session' => 1,
                        'order_id' => $_REQUEST['orderID'],
                    ]);
                }
                Ordering::where('payment_id', $_REQUEST['paymentID'])->update([
                    'all_session' => Session::getId(),
                ]);
            }
            $sent = $this->sentameri($_REQUEST['paymentID']);
            return redirect()->route('successallpay');exit;
        }
    }
    public function sentameri($paymentID){
            $username = "3d19541048";
            $password = "lazY2k";
            $headers = [
                'Content-Type:application/json',
            ];
            $array = array("PaymentID" => $paymentID,"Username"=>$username,"Password"=>$password);
            $postData = json_encode($array,JSON_PRESERVE_ZERO_FRACTION);
            $url = "https://servicestest.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails";
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
    }
    public function successallpay() {
        $success_id = Ordering::where('session', Session::getId())->where('show', 1)->first();
        if($success_id == null) {
            $success_id = Ordering::where('session', 1)->where('show', 1)->where('all_session', Session::getId())->first();
            if($success_id == null) {
                return redirect('/');
            }
        }
        $show_null = Ordering::where('all_session', Session::getId())->where('show', 1)->update(['show' => 0]);
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
        return view('evrika.success')->with([
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
            'success_id' => $success_id,
        ]);
    }
    public function nosuccessallpay(Request $request) {
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
        return view('evrika.nosuccess')->with([
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
        ]);
    }
    protected function orderfullend() {
        $order_full = Ordering::where('all_session', Session::getId())->where('show', 1)->first();
        return $order_full;
    }
}
