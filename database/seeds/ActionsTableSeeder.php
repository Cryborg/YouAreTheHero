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
                'id' => 1,
                'trigger_type' => 'page',
                'trigger_id' => 72,
                'actionable_type' => 'field',
                'actionable_id' => 6,
                'quantity' => -1,
                'created_at' => '2020-05-28 19:58:48',
                'updated_at' => '2020-05-28 19:58:48',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'trigger_type' => 'page',
                'trigger_id' => 137,
                'actionable_type' => 'item',
                'actionable_id' => 15,
                'quantity' => 1,
                'created_at' => '2020-05-29 14:46:50',
                'updated_at' => '2020-05-29 14:46:50',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'trigger_type' => 'page',
                'trigger_id' => 137,
                'actionable_type' => 'item',
                'actionable_id' => 16,
                'quantity' => 10,
                'created_at' => '2020-05-29 14:47:16',
                'updated_at' => '2020-05-29 14:47:16',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'trigger_type' => 'page',
                'trigger_id' => 137,
                'actionable_type' => 'item',
                'actionable_id' => 17,
                'quantity' => 1,
                'created_at' => '2020-05-29 14:47:44',
                'updated_at' => '2020-05-29 14:47:44',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'trigger_type' => 'page',
                'trigger_id' => 137,
                'actionable_type' => 'item',
                'actionable_id' => 18,
                'quantity' => 1,
                'created_at' => '2020-05-29 14:52:38',
                'updated_at' => '2020-05-29 14:52:38',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'trigger_type' => 'page',
                'trigger_id' => 169,
                'actionable_type' => 'item',
                'actionable_id' => 42,
                'quantity' => 1,
                'created_at' => '2020-08-13 06:53:35',
                'updated_at' => '2020-08-13 06:53:35',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'trigger_type' => 'page',
                'trigger_id' => 171,
                'actionable_type' => 'item',
                'actionable_id' => 43,
                'quantity' => -1,
                'created_at' => '2020-08-13 14:40:42',
                'updated_at' => '2020-08-13 14:40:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}