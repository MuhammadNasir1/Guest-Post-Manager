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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("transaction_id")->nullable();
            $table->string("invoice_no");
            $table->string("user_id");
            $table->string("amount");
            $table->string("currency");
            $table->string("payment_method");
            $table->string("website");
            $table->string("status");
            $table->string("cust_name");
            $table->string("cust_email");
            $table->string("cust_phone_no");
            $table->string("total_amount")->nullable();
            $table->string("payable_amount")->nullable();
            $table->text("description")->nullable();
            $table->dateTime("datetime")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
