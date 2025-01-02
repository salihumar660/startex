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
        Schema::create('dtn_efts', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('eft')->nullable();
            $table->string('date')->nullable();
            $table->string('eft_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtn_efts');
    }
};
