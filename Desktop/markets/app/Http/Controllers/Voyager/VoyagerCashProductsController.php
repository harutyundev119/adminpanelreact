<?php

namespace App\Http\Controllers\Voyager;
use App\OrderingProduct;
use App\Ordering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ReflectionClass;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Database\Schema\Table;
use TCG\Voyager\Database\Types\Type;
use TCG\Voyager\Events\BreadAdded;
use TCG\Voyager\Events\BreadDeleted;
use TCG\Voyager\Events\BreadUpdated;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;
use Illuminate\Support\Facades\Hash;

class VoyagerCashProductsController extends BaseVoyagerController
{
    public function nocashProducts() {
        $nocash_products = Ordering::all()->where('cash', 0);
        return view('vendor.voyager.orderings.nocash_products')->with(compact('nocash_products'));
    }

    public function cashProducts(){
        $cash_products = Ordering::all()->where('cash', 1);
        return view('vendor.voyager.ordered.cash_products')->with(compact('cash_products'));

    }

    public function edit_password($id){
        $company = Company::all()->where('id', $id)->first();
        return view('vendor.voyager.company.edit_password')->with(compact('company', 'company'));
    }

    public function edit_password_post(Request $request, $id){
        $company = Company::all()->where('id', $id)->first();
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $company->password = Hash::make($request->password);
        if($company->save()){
            return redirect('admin/companies')->with('status', 'Password succesfuly updated!');
        }


        return back();
    }

    public function order_add_paid(Request $request){
        $id = $request->ordered_product_id;
        $order_paid = Ordering::where('id',$id)->first();
        $order_paid->order_status = 1;
        if($order_paid->save()){
            echo 'paid';exit;
        }else{
            echo 'error';exit;
        }
    }
}
