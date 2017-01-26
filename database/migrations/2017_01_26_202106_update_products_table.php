<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function ($table) {
            $table->dropColumn('shipping');
            $table->string('shipping_text')->nullable()->after('per_bottle');
            $table->integer('shipping_cost')->after('shipping_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function ($table) {
            $table->dropColumn('shipping_text');
            $table->dropColumn('shipping_cost');
            $table->string('shipping_text')->nullable()->after('per_bottle');
        });
    }
}
