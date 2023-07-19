<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryChargesAndCommisionToOrderCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_carts', function (Blueprint $table) {
            $table->double('delivery_charges')->nullable();
            $table->double('commission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_carts', function (Blueprint $table) {
            $table->dropColumn('delivery_charges');
            $table->dropColumn('commission');
        });
    }
}
