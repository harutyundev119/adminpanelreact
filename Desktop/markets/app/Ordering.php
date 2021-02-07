<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Ordering extends Model
{
    protected $fillable = ['user_id', 'order_id', 'customer_city', 'customer_addres', 'email', 'customer_telephone', 'order_status', 'curensy', 'amount', 'session', 'payment_id'];

}
