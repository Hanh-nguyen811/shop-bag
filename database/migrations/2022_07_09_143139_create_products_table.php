<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->longText('content');
            $table->integer('id_brand')->unsigned();
            $table->foreign('id_brand')->references('id')->on('brands');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id')->on('types');
            $table->integer('id_menu');
            $table->integer('price') ;
            $table->integer('product_sold')->nullable();
            $table->integer('price_cost') ;
            $table->integer('pro_quantity');
            $table->string('image') ;
            $table->integer('status');
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
};
