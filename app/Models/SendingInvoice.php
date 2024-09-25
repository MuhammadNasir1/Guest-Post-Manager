<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingInvoice extends Model
{
    use HasFactory;
    protected $table = 'sending_invoice';
    protected  $fillable = [

        'user_id',
        'invoice_no',
        'sending_date',
        'amount',
        'website',
        'invoice_url',
        'payment_method',
        'pkr_amount',
        'bank_name',
        'Transaction_id',
        'status',
    ];
    protected $timestamp = true;
}
