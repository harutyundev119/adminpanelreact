<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Faquestion extends Model
{
    public $timestamps = false;
    use Translatable;
    protected $translatable = ['question','answere'];

}