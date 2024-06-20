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
        Schema::table('users', function (Blueprint $table) {
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('user_image')->nullable();
            $table->string('verification')->default("pending");
            $table->string('tax_number')->nullable();
            $table->string('client_type')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
