<?php

use App\Models\Clinic;
use App\Models\Patient;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->string('detail');
            $table->string('employee_name');
            $table->datetime('date');
            $table->tinyInteger('visit_count')->nullable();
            $table->string('note')->nullable();
            $table->string('status')->default('Đang hẹn');
            $table->string('last_update_name')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
