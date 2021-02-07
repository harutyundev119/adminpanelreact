<?php

namespace App\Http\Controllers;
use App\Bonus;
use Illuminate\Http\Request;

class BonusController extends Controller
{
   public function insertbonus(Request $data)
    { 

     $Gifcard = Bonus::create([
    'name' => $data['name'],
    'max' => $data['max'],
    'min' => $data['min'],
    'percent' => $data['percent'],
  ]);

     $data = Bonus::all();

    return redirect()->intended('bonus');

 }

     public function pagebonus()
    {

      $data = Bonus::all();

 return view('medshop.bonus')->with([
            'data' => $data,
        ]);

    }


    

       public function deletbonus($id)
    {
      $data = Bonus::where('id',$id)->delete();

      
   return redirect()->intended('bonus');

    }

}
