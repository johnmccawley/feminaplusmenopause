<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CouponCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function ($table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('discount_amount')->nullable();
            $table->string('discount_type');
            $table->timestamps();
        });

        Schema::table('carts', function ($table) {
            $table->integer('charge_total')->after('total')->default(0);
            $table->text('codes_applied')->after('charge_total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');

        Schema::table('carts', function ($table) {
            $table->dropColumn('charge_total');
            $table->dropColumn('codes_applied');
        });
    }
}
