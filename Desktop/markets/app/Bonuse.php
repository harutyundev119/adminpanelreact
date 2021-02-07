<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonuse extends Model
{
    protected $fillable = [
        'name', 'max', 'min', 'percent'
    ];
}
