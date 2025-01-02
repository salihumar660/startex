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
        Schema::create('user_attandances', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->nullable();
            $table->string("ip_address")->nullable();
            $table->string("latlng")->nullable();
            $table->string("status")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attandances');
    }
};
