<?php

use App\Models\Clinic;
use App\Models\ServiceGroup;
use App\Models\Supplier;
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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->foreignIdFor(ServiceGroup::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Supplier::class)->nullable()->constrained()->cascadeOnUpdate();
            $table->string('name');
            // $table->integer('bonus')->nullable();
            // $table->integer('cost')->nullable();
            $table->string('caculation_unit')->nullable();
            $table->string('monetary_unit');
            $table->integer('price');
            $table->boolean('warranty_able');
            $table->string('warranty')->nullable();
            $table->string('last_update_name')->default('admin');
            $table->boolean('active');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
