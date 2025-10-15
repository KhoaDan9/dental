<?php

use App\Models\Finance;
use App\Models\FundingSource;
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
        Schema::create('transaction_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate();
            $table->string('recipient')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('type_of_transaction')->default('Tiền mặt');
            $table->foreignIdFor(Finance::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(FundingSource::class)->constrained()->cascadeOnUpdate();
            $table->integer('money');
            $table->string('detail');
            $table->string('note')->nullable();
            $table->boolean('is_receipt')->default(false);
            $table->string('last_update_name')->default('admin');
            $table->datetime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_vouchers');
    }
};
