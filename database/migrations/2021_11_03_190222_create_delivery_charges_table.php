<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_charges', function (Blueprint $table) {
            $table->id();
            $table->text('pick_up_location');
            $table->text('drop_location');
            $table->bigInteger('order_id');
            $table->decimal('delivery_charges', 8, 2);
            $table->decimal('total_commission', 8, 2)->nullable();
            $table->enum('accepted_status', ['preparing','ready to collect','delivered'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
