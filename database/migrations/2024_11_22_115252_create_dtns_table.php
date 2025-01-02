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
        Schema::create('dtns', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('order')->nullable();
            $table->string('terminal_zone')->nullable();
            $table->string('transport')->nullable();
            $table->string('date')->nullable();
            $table->string('rack')->nullable();
            $table->string('commission')->nullable();
            $table->string('bol')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtns');
    }
};
