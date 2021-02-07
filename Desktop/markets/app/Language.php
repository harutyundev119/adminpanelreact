<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;


class Language extends Model
{
    use Translatable;
    protected $translatable = ['name','iso'];
    public $timestamps = false;
}
