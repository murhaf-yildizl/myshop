<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_supports', function (Blueprint $table) {
            $table->bigIncrements('contact_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('support_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->string('status')->default('pending...');

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('support_id')->references('support_id')->on('supports')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');

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
        Schema::dropIfExists('contact_supports');
    }
}
