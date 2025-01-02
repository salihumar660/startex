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
        Schema::create('dtn_bols', function (Blueprint $table) {
            $table->id();
            $table->string('bol_no')->nullable();
            $table->string('terminal_control_number')->nullable();
            $table->string('terminal_name')->nullable();
            $table->string('fuel_product_qty')->nullable();
            $table->string('total_fuel_product_qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtn_bols');
    }
};
