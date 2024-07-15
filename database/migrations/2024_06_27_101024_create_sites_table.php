<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('web_url');
            $table->string('traffic');
            $table->string('semrush_traffic');
            $table->string('ahref_traffic');
            $table->string('traffic_from');
            $table->string('guest_post_price');
            $table->string('link_insertion_price');
            $table->string('exchange');
            $table->string('contact_no');
            $table->string('admin_gmail');
            $table->string('site_done_from');
            $table->string('dr');
            $table->string('da');
            $table->string('casino');
            $table->string('category');
            $table->text('guideline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
