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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('category');
            $table->string('sub_category')->nullable();
            $table->string('tags')->nullable();
            $table->string('rate');
            $table->string('tax')->nullable();
            $table->string('quantity');
            $table->string('quantity_alert')->nullable();
            $table->string('status');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('product_unit');
            $table->string('unit_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
