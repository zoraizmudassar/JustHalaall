<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('restaurant_id');
            $table->bigInteger('category_id');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->double('price', 8,2);
            $table->string('delivery_time')->nullable();
            $table->string('image')->nullable();
            $table->enum('rating', ['1', '2', '3', '4','5'])->default('1');
            $table->enum('status', [0,1])->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('deals');
    }
}
