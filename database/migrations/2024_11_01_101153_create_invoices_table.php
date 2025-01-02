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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('gasoline')->nullable();
            $table->string('description')->nullable();
            $table->string('rack')->nullable();
            $table->string('tax')->nullable();
            $table->string('commission')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->nullable();
            $table->string('card_date')->nullable();
            $table->string('card_ref')->nullable();
            $table->string('card_net')->nullable();
            $table->string('charges_transportation_amount')->nullable();
            $table->string('charges_gilbarco_amount')->nullable();
            $table->string('charges_tx_delivery_fee')->nullable();
            $table->string('charges_cybera')->nullable();
            $table->string('charges_fed_oil_spil_fee')->nullable();
            $table->string('charges_transport_surcharge')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('add_charges')->nullable();
            $table->string('credit_cards')->nullable();
            $table->string('net_amount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
