<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWichListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wich_lists', function (Blueprint $table) {
            $table->bigIncrements('wish_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('items')->nullable();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            

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
        Schema::dropIfExists('wich_lists');
    }
}
