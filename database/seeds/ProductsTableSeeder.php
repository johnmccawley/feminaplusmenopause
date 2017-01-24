<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'MONTHLY AUTO-REFILL',
            'full_name' => 'Femina Plus Club Refill',
            'description' => '1 Bottle a Month for 12 Months (13th Bottle Free!)',
            'image' => 'img/bottle.png',
            'sku' => 'fpClub',
            'price' => 3600,
            'per_bottle' => NULL,
            'shipping' => NULL,
            'subscription' => true,
            'more_info' => '13TH BOTTLE FREE!'
        ]);
        DB::table('products')->insert([
            'id' => 2,
            'name' => 'TWO-PACK',
            'full_name' => 'Femina Plus 2 Pack',
            'description' => '2 bottles',
            'image' => 'img/bottle-two.png',
            'sku' => 'twoBottle',
            'price' => 7790,
            'per_bottle' => '$38.95 per bottle',
            'shipping' => NULL,
            'subscription' => false,
            'more_info' => NULL
        ]);
        DB::table('products')->insert([
            'id' => 3,
            'name' => 'FOUR-PACK',
            'full_name' => 'Femina Plus 4 Pack',
            'description' => '4 bottles',
            'image' => 'img/bottle-four.png',
            'sku' => 'fourBottle',
            'price' => 14990,
            'per_bottle' => '$37.95 per bottle',
            'shipping' => NULL,
            'subscription' => false,
            'more_info' => NULL
        ]);
        DB::table('products')->insert([
            'id' => 4,
            'name' => 'SINGLE BOTTLE',
            'full_name' => 'Femina Plus Single Bottle',
            'description' => '1 bottle',
            'image' => 'img/bottle.png',
            'sku' => 'oneBottle',
            'price' => 3950,
            'per_bottle' => NULL,
            'shipping' => '+ Shipping & Handling',
            'subscription' => false,
            'more_info' => NULL
        ]);
    }
}
