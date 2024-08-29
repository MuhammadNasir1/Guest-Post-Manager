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
        Schema::create('sending_invoice', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('invoice_no')->nullable();
            $table->date('sending_date')->nullable();
            $table->string('Amount');
            $table->string('website');
            $table->string('invoice_url');
            $table->string('payment_method');
            $table->string('pkr_amount')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sending_invoice');
    }
};
