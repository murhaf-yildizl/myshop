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
            $table->bigIncrements('product_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->double('price');
            $table->double('available');
            $table->double('discount')->default(0);
            $table->text('options')->nullable();
            $table->bigInteger('cat_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();

            $table->foreign('cat_id')->references('cat_id')->on('categories')->onDelete('cascade');
            $table->foreign('unit_id')->references('unit_id')->on('units')->onDelete('cascade');
        
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
