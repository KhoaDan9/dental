<?php

use App\Models\Employee;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            // $table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
            $table->date('birth');
            $table->string('phone');
            $table->string('from');
            $table->string('from_note')->nullable();
            $table->string('medical_history')->nullable();
            $table->string('medical_history_note')->nullable();
            $table->string('medical_examination');
            $table->string('address');
            $table->string('commune')->nullable();
            $table->string('city')->nullable();
            $table->string('note')->nullable();
            $table->string('gender');
            $table->string('patient_status');
            $table->string('last_update_name')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
