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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('user_id')->nullable();
            $table->string('account_active')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('zone')->nullable();
            $table->string('card_id')->nullable();
            $table->string('pin')->nullable();
            $table->string('miles')->nullable();
            $table->string('user_pin')->nullable();
            $table->string('password')->nullable();
            $table->string('access')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('cell')->nullable();
            $table->string('email')->nullable();
            $table->string('cus_group')->nullable();
            $table->string('opening_bal')->nullable();
            $table->string('current_bal')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('post_credit_card_in_each_invoice')->nullable();
            $table->string('credit_type')->nullable();
            $table->string('credit_days')->nullable();
            $table->string('accept_split_order')->nullable();
            $table->string('transport_include_in_price')->nullable();
            $table->string('peach')->nullable();
            $table->string('income')->nullable();
            $table->string('acc_rec')->nullable();
            $table->string('acc_pay')->nullable();
            $table->string('brand_invoice_acc')->nullable();
            $table->string('card_pin')->nullable();
            $table->string('brand')->nullable();
            $table->string('terminal')->nullable();
            $table->string('distributor')->nullable();
            $table->string('Brand_transport')->nullable();
            $table->string('credit_company')->nullable();
            $table->string('contract_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('set_price')->nullable();
            $table->string('buy_pass')->nullable();
            $table->string('transport')->nullable();
            $table->string('sign_maintanance')->nullable();
            $table->string('invested_by')->nullable();
            $table->string('owner')->nullable();
            $table->string('salesman')->nullable();
            $table->string('cont_person')->nullable();
            $table->string('quiraga_fuelRate')->nullable();
            $table->string('quiraga_dieselRate')->nullable();
            $table->string('quiraga_flatRate')->nullable();
            $table->string('startex_gas_oil_fuelRate')->nullable();
            $table->string('startex_gas_oil_dieselRate')->nullable();
            $table->string('startex_gas_oil_flatRate')->nullable();
            $table->string('texas_trans_fuelRate')->nullable();
            $table->string('texas_trans_dieselRate');
            $table->string('texas_trans_flatRate');
            $table->string('coastal_transport_fuelRate')->nullable();
            $table->string('coastal_transport_dieselRate')->nullable();
            $table->string('coastal_transport_flatRate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_details');
    }
};
