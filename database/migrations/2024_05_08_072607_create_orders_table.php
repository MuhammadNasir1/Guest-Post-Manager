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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('order_date');
            $table->string('customer_name')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_adress')->nullable();
            $table->string('sub_total');
            $table->string('order_vat')->nullable();
            $table->string('discount')->nullable();
            $table->string('grand_total');
            $table->string('order_description')->nullable();
            $table->string('order_tracking')->nullable();
            $table->string('order_note')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('order_status')->nullable();
            $table->string('delivery_charges')->nullable();
            $table->string('order_from')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
