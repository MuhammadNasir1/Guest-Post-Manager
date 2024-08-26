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
            $table->string('ahref_traffic')->nullable();
            $table->string('traffic_from')->nullable();
            $table->string('guest_post_price');
            $table->string('link_insertion_price');
            $table->string('exchange')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('admin_gmail')->nullable();
            $table->string('site_done_from')->nullable();
            $table->string('dr')->nullable();
            $table->string('da')->nullable();
            $table->string('casino')->nullable();
            $table->string('category');
            $table->text('guideline')->nullable();
            $table->string('insertion_currency')->nullable();
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
