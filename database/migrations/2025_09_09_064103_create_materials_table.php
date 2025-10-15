<?php

use App\Models\MaterialGroup;
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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->foreignIdFor(MaterialGroup::class)->constrained()->cascadeOnUpdate();
            $table->string('name');
            $table->string('describe')->nullable();
            $table->string('caculation_unit')->nullable();
            $table->string('monetary_unit')->default('VNĐ');
            $table->integer('price');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('materials');
    }
};
