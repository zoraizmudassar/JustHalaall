<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('restaurant_id');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->mediumText('delivery_time')->nullable();
            $table->double('price', 8,2);
            $table->string('images')->nullable();
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_available')->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected', 'enabled','disabled'])->default('pending');
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
        Schema::dropIfExists('products');
    }
}
