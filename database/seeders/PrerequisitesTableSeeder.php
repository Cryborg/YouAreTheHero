<?php

namespace Database\Seeders;

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
                'deleted_at' => NULL,
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
                'deleted_at' => NULL,
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
                'deleted_at' => NULL,
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
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 37,
                'page_id' => 159,
                'created_at' => '2020-07-28 13:01:40',
                'updated_at' => '2020-07-28 13:01:40',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'quantity' => 1,
                'prerequisiteable_type' => 'item',
                'prerequisiteable_id' => 43,
                'page_id' => 171,
                'created_at' => '2020-08-13 07:03:05',
                'updated_at' => '2020-08-13 07:03:05',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'quantity' => 12,
                'prerequisiteable_type' => 'field',
                'prerequisiteable_id' => 11,
                'page_id' => 175,
                'created_at' => '2020-08-14 06:56:11',
                'updated_at' => '2020-08-14 06:56:11',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'quantity' => 12,
                'prerequisiteable_type' => 'field',
                'prerequisiteable_id' => 12,
                'page_id' => 176,
                'created_at' => '2020-08-14 08:33:49',
                'updated_at' => '2020-08-14 08:33:49',
                'deleted_at' => NULL,
            ),
        ));


    }
}
