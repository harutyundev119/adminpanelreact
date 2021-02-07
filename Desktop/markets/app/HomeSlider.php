<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.05.2020
 * Time: 15:05
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;



class HomeSlider extends Model
{
    public $timestamps = false;
    use Translatable;
    protected $translatable = ['title','text'];

}