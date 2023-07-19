<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('order_no')->nullable();
            $table->date('order_place_date')->default(Carbon::now());
            $table->enum('payment_status', ['pending', 'approved'])->default('pending');
            $table->string('charge_id')->nullable();
            $table->enum('payment_type', ['coc', 'cod', 'card'])->default('cod');
            $table->bigInteger('status_id')->constrained()->onDelete('cascade');
            $table->bigInteger('user_id');
            $table->text('cancel_reason')->nullable();
            $table->integer('stripe_payment_id')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
