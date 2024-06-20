<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $timeStamp   = true;
    protected $fillable = [
        'name',
        'code',
        'category',
        'sub_category',
        'tags',
        'rate',
        'tax',
        'quantity',
        'quantity_alert',
        'product_unit',
        'unit_quantity',
        'status',
        'image',
        'description'
    ];
}
