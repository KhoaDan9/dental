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
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->string('name');
            $table->string('group');
            $table->boolean('receipt')->default(false);
            $table->boolean('payment')->default(false);
            $table->string('note')->nullable();
            $table->boolean('active');
            $table->string('last_update_name')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
