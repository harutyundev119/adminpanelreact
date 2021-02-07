<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.05.2020
 * Time: 11:04
 */

namespace App;
namespace App;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class AboutExperience extends Model
{
    public $timestamps = false;
    use Translatable;
    protected $translatable = ['title'];

}