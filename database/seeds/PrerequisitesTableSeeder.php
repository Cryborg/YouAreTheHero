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
                'page_uuid' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 2,
                'created_at' => '2020-01-10 16:20:15',
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'page_uuid' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'prerequisiteable_type' => 'character_stat',
                'prerequisiteable_id' => 1,
                'created_at' => '2020-01-10 16:20:26',
                'updated_at' => NULL,
            ),
        ));


    }
}
