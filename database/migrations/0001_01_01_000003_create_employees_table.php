<?php

use App\Models\Clinic;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->string('full_name')->nullable();
            $table->string('name');
            $table->date('birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('citizen_id')->nullable();
            $table->string('email')->nullable();
            // $table->string('salary')->nullable();
            $table->string('note')->nullable();
            $table->boolean('doctor');
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
        Schema::dropIfExists('employees');
    }
};
