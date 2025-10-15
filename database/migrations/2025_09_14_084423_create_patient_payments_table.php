<?php

use App\Models\FundingSource;
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
        Schema::create('patient_payments', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(FundingSource::class)->constrained()->cascadeOnUpdate();
            $table->datetime('date');
            $table->tinyInteger('visit_count')->nullable();
            $table->string('employee_name');
            $table->string('type_of_transaction');
            $table->integer('paid')->default(0);
            $table->string('detail');
            $table->string('note')->nullable();
            $table->string('last_update_name')->default('admin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_payments');
    }
};
