<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected    $fillable = [
        'user_id',
        'web_url',
        'traffic',
        'semrush_traffic',
        'ahref_traffic',
        'traffic_from',
        'guest_post_price',
        'link_insertion_price',
        'dr',
        'da',
        'exchange',
        'contact_no',
        'casino',
        'category',
        'site_done_from',
        'admin_gmail',
        'guideline',

    ];
}
