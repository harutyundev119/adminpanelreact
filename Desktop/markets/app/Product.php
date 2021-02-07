<?php

namespace App;

use App\Services\CurrencyConversion;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use Translatable;
    protected $translatable = ['name','title', 'description', 'active_substance', 'aftor', 'country', 'manufacturer'];
    protected $fillable = [
        'name', 'category', 'price', 'count', 'title', 'description', 'active_substance', 'aftor' , 'action_price'
    ];

    public function getPriceAttribute($value) {
        return round(CurrencyConversion::convert($value),2);
    }

}
