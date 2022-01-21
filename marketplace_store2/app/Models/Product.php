<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'prod_name',
        'prod_description',
        'prod_score',
        'prod_price',
        'prod_in_stock',
    ];
}
