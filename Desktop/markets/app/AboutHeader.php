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


class AboutHeader extends Model
{
    public $timestamps = false;
    use Translatable;
    protected $translatable = ['header','first_title','first_text','second_title','second_text','image_text'];

}