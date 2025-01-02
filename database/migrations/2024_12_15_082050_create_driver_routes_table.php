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
        Schema::create('driver_routes', function (Blueprint $table) {
            $table->id();
            $table->string('driver_id')->nullable();
            $table->string('to_address')->nullable();
            $table->string('from_address')->nullable();
            $table->string('charges')->nullable();
            $table->string('count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_routes');
    }
};
