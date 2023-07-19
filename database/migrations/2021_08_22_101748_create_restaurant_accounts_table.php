<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('card_number');
            $table->string('expiry');
            $table->string('security_code')->nullable();
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
        Schema::dropIfExists('restaurant_accounts');
    }
}
