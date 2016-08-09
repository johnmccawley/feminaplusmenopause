<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaypalDatabaseEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases', function ($table) {
            $table->dropColumn('stripe_transaction_id');
            $table->string('transaction_id')->after('amount')->nullable();
            $table->string('payment_processor')->after('amount')->nullable();
            $table->string('purchase_status')->after('user_id')->nullable();
            $table->text('customer_info')->after('user_id')->nullable();
            $table->string('token')->after('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function ($table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('payment_processor');
            $table->dropColumn('purchase_status');
            $table->dropColumn('customer_info');
            $table->dropColumn('token');
            $table->string('stripe_transaction_id')->after('amount');
        });
    }
}
