<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optionlists', function (Blueprint $table) {
          $table->bigIncrements('optionlist_id')->unsigned();
          $table->bigInteger('option_id')->unsigned();
          $table->string('value');

          $table->foreign('option_id')->references('option_id')->on('options')->onDelete('cascade');


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
        Schema::dropIfExists('optionlists');
    }
}
