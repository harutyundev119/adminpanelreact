<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelcelController extends Controller
{

    public function index()
    {
        return view('evrika.payment.telcel')->with(['order_id'=>'1111111']);
    }
}
