<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected  $table = "orders";
    protected  $fillable = [
        'user_id',
        'order_date',
        'customer_name',
        'customer_id',
        'customer_phone',
        'customer_adress',
        'sub_total',
        'order_vat',
        'discount',
        'grand_total',
        'order_description',
        'order_tracking',
        'order_note',
        'payment_type',
        'order_status',
        'delivery_charges',
        'order_from',

    ];
    protected $timestamp =  true;
}
