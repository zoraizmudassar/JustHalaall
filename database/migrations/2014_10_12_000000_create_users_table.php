<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name',100)->nullable();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->string('phone',20)->unique()->nullable();
            $table->string('email',100)->nullable();
            $table->string('password');
            $table->mediumText('address')->nullable();
            $table->string('avatar',100)->nullable();
            $table->string('verification_code')->nullable();
            $table->boolean('is_verified')->default(0);
            $table->string('device_token')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->text('access_token')->nullable();
            $table->rememberToken();
            $table->timestamps();

//            $table->foreign('role_id')->references('id')->on('roles')->onDelete('casecade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
