<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actions')->delete();
        
        \DB::table('actions')->insert(array (
            0 => 
            array (
                'id' => 2,
                'item_id' => 2,
                'verb' => 'buy',
                'quantity' => 1,
                'price' => NULL,
                'page_id' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
            ),
            1 => 
            array (
                'id' => 3,
                'item_id' => 1,
                'verb' => 'buy',
                'quantity' => 1,
                'price' => NULL,
                'page_id' => '3442f8a3-3a40-3251-b4c8-445ff8c24595',
            ),
            2 => 
            array (
                'id' => 5,
                'item_id' => 1,
                'verb' => 'buy',
                'quantity' => 1,
                'price' => 0,
                'page_id' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
            ),
        ));
        
        
    }
}