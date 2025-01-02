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
        Schema::create('driver_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('ld')->nullable();
            $table->string('zone')->nullable();
            $table->string('order_number')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('bl_number')->nullable();
            $table->string('mileage_begin')->nullable();
            $table->string('load_started')->nullable();
            $table->string('unloading_started')->nullable();
            $table->string('rack')->nullable();
            $table->string('end')->nullable();
            $table->string('finished')->nullable();
            $table->string('finished_2')->nullable();
            $table->string('load_account')->nullable();
            $table->string('consigned_to')->nullable();
            $table->string('extra_tank_reading')->nullable();
            $table->string('station_fuel_required')->nullable();
            $table->json('station_fuel')->nullable();
            $table->string('truck_pump_required')->nullable();
            $table->json('truck_pump')->nullable();
            $table->string('received_in_good_order')->nullable();
            $table->date('date')->nullable();
            $table->string('driver')->nullable();
            $table->string('received_check')->nullable();
            $table->date('dated')->nullable();
            $table->string('amount')->nullable();
            $table->string('cod_check')->nullable();
            $table->text('signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_tickets');
    }
};
