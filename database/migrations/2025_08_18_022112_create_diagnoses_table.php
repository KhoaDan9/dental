<?php

use App\Models\DiagnosisGroup;
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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->foreignIdFor(DiagnosisGroup::class)->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->string('note')->nullable();
            $table->string('last_update_name')->default('admin');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
