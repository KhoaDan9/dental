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
        Schema::create('clinics', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            // $table->string('short_name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('license')->nullable();
            $table->string('city')->default('Hà Nội');
            $table->string('commune')->default('Thạch Thất');
            $table->string('note')->nullable();
            $table->string('logo_path')->nullable();
            $table->boolean('active')->default(true);
            $table->string('last_update_name')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
