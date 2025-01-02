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
        Schema::create('purchase_sales', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('date')->nullable();
            $table->string('bol')->nullable();
            $table->string('company')->nullable();
            $table->string('driver')->nullable();
            $table->string('gallon')->nullable();
            $table->string('gross_amt')->nullable();
            $table->string('charges')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('receive')->nullable();
            $table->string('rec_date')->nullable();
            $table->string('in_days')->nullable();
            $table->string('transport_charges')->nullable();
            $table->string('purchase_amount')->nullable();
            $table->string('difference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_sales');
    }
};
