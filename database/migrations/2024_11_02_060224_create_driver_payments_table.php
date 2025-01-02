<?php

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
        Schema::create('driver_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('pay_date')->nullable();
            $table->string('check')->nullable();
            $table->string('pay_amount')->nullable();
            $table->string('Note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_payments');
    }
};
