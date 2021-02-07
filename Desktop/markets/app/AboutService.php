<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.04.2020
 * Time: 16:32
 */

namespace App;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class AboutService extends Model
{
    public $timestamps = false;
    use Translatable;
    protected $translatable = ['title','text'];

}