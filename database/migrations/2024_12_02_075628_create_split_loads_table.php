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
        Schema::create('split_loads', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('date')->nullable();
            $table->string('pickup_load')->nullable();
            $table->string('remaining_load')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('split_loads');
    }
};
