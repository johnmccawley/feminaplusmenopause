<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('full_name');
            $table->string('description');
            $table->string('image');
            $table->string('sku');
            $table->integer('price');
            $table->string('per_bottle')->nullable();
            $table->string('shipping')->nullable();
            $table->string('subscription')->nullable();
            $table->string('more_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
