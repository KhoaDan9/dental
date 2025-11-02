<?php

use App\Models\Employee;
use App\Models\Patient;
use App\Models\Service;
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
        Schema::create('patient_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Service::class)->constrained()->cascadeOnUpdate();
            $table->foreignId('supporter_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('symptom')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('teeth')->nullable();
            $table->integer('price');
            $table->integer('total_price');
            $table->integer('quantity');
            $table->tinyInteger('discount1')->default(0);
            $table->integer('discount2')->default(0);
            $table->string('last_update_name')->default('admin');
            $table->string('note')->nullable();
            $table->datetime('date');
            $table->tinyInteger('visit_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_services');
    }
};
