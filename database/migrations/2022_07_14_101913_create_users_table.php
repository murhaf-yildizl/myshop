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
            $table->bigIncrements('user_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->boolean('phone_verified')->default(false);

            $table->bigInteger('billing_Address_id')->unsigned()->nullable();
            $table->bigInteger('shipping_Address_id')->unsigned()->nullable();

            $table->foreign('billing_Address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->foreign('shipping_Address_id')->references('address_id')->on('addresses')->onDelete('cascade');



            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
