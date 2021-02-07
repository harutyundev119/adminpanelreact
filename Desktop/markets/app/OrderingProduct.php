<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class OrderingProduct extends Model
{
    use Translatable;
    protected $translatable = ['product_name'];
    protected $fillable = [
        'product_id', 'image', 'product_name', 'order_id', 'roduct_price', 'quantity','user_id','session'
    ];
    
}
