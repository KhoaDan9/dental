<?php

use App\Models\PatientService;
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
        Schema::create('warranty_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PatientService::class)->constrained()->cascadeOnDelete();
            $table->string('service_name');
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->string('card_id')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('warranty_status')->default('Không phát hành');
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
        Schema::dropIfExists('warranty_cards');
    }
};
