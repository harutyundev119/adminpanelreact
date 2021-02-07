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
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\OrderingProduct;
use Session;
use Socialite;
use App\SocialProvider;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
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

        return view('auth.register')->with([
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        try {

            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e) {
            return redirect('/');
        }
        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();

        if(!$socialProvider) {
            $motdepasse = Str::random(6);
            $user = User::firstOrCreate([
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName(),
                'password'=>bcrypt($motdepasse),
            ]);
            $user->socialProviders()->create(
                ['provider_id' => $socialUser->getId(), 'provider' => $provider]
            );
        } else {
            $user = $socialProvider->user;
        }
        auth()->login($user);
        return redirect('/');
    }
}
