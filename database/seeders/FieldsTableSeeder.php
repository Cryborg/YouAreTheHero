<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('fields')->delete();

        \DB::table('fields')->insert(array (
            0 =>
            array (
                'id' => 1,
                'story_id' => 4,
                'name' => 'Vitesse',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:56:09',
                'updated_at' => '2020-05-12 14:56:09',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'story_id' => 4,
                'name' => 'Force',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:56:22',
                'updated_at' => '2020-05-12 14:56:22',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'story_id' => 4,
                'name' => 'Endurance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-12 14:58:41',
                'updated_at' => '2020-05-12 14:58:41',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'story_id' => 7,
                'name' => 'Endurance',
                'hidden' => 0,
                'min_value' => 10,
                'max_value' => 20,
                'start_value' => 10,
                'order' => 1,
                'created_at' => '2020-05-19 08:56:19',
                'updated_at' => '2020-05-28 19:55:46',
                'deleted_at' => '2020-05-28 19:55:46',
            ),
            4 =>
            array (
                'id' => 5,
                'story_id' => 7,
                'name' => 'Chance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-19 08:56:26',
                'updated_at' => '2020-05-28 19:55:45',
                'deleted_at' => '2020-05-28 19:55:45',
            ),
            5 =>
            array (
                'id' => 6,
                'story_id' => 7,
                'name' => 'Endurance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-28 19:56:37',
                'updated_at' => '2020-05-28 19:56:37',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'story_id' => 7,
                'name' => 'Chance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-05-28 19:56:44',
                'updated_at' => '2020-05-28 19:56:44',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'story_id' => 14,
                'name' => 'Chance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-06-02 15:04:00',
                'updated_at' => '2020-06-12 17:58:16',
                'deleted_at' => '2020-06-12 17:58:16',
            ),
            8 =>
            array (
                'id' => 9,
                'story_id' => 13,
                'name' => 'Luke',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-06-02 15:05:05',
                'updated_at' => '2020-06-02 15:05:05',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'story_id' => 19,
                'name' => 'Concentration',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-07-28 12:57:07',
                'updated_at' => '2020-07-28 12:57:07',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'story_id' => 23,
                'name' => 'Force',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-08-13 04:37:28',
                'updated_at' => '2020-08-13 04:37:28',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'story_id' => 23,
                'name' => 'Endurance',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-08-13 04:37:48',
                'updated_at' => '2020-08-13 04:37:48',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'story_id' => 24,
                'name' => 'Perception',
                'hidden' => 0,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-08-19 02:42:04',
                'updated_at' => '2020-08-19 02:42:04',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'story_id' => 24,
                'name' => 'Completude',
                'hidden' => 1,
                'min_value' => 1,
                'max_value' => 10,
                'start_value' => 1,
                'order' => 1,
                'created_at' => '2020-08-19 02:42:26',
                'updated_at' => '2020-08-19 02:42:26',
                'deleted_at' => NULL,
            ),
        ));
    }
}
