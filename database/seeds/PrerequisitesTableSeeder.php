<?php

use Illuminate\Database\Seeder;

class PrerequisitesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('prerequisites')->delete();
        
        \DB::table('prerequisites')->insert(array (
            0 => 
            array (
                'id' => 1,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 3,
                'page_id' => 21,
                'created_at' => '2020-05-14 06:03:21',
                'updated_at' => '2020-05-14 06:03:21',
            ),
            1 => 
            array (
                'id' => 2,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 1,
                'page_id' => 19,
                'created_at' => '2020-05-14 06:03:41',
                'updated_at' => '2020-05-14 06:03:41',
            ),
            2 => 
            array (
                'id' => 3,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 2,
                'page_id' => 20,
                'created_at' => '2020-05-14 06:03:53',
                'updated_at' => '2020-05-14 06:03:53',
            ),
            3 => 
            array (
                'id' => 4,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 4,
                'page_id' => 22,
                'created_at' => '2020-05-14 06:05:31',
                'updated_at' => '2020-05-14 06:05:31',
            ),
        ));
        
        
    }
}