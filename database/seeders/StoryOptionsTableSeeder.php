<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoryOptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('story_options')->delete();

        \DB::table('story_options')->insert(array (
            0 =>
            array (
                'id' => 1,
                'story_id' => 4,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-09 14:04:38',
                'updated_at' => '2020-05-09 14:04:47',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'story_id' => 5,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-12 11:26:15',
                'updated_at' => '2020-05-12 11:26:15',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'story_id' => 6,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-17 09:19:23',
                'updated_at' => '2020-05-17 09:19:23',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'story_id' => 7,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-19 08:56:05',
                'updated_at' => '2020-05-19 08:56:06',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'story_id' => 8,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-19 12:45:56',
                'updated_at' => '2020-05-19 12:45:56',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'story_id' => 9,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-23 20:25:42',
                'updated_at' => '2020-05-23 20:26:02',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'story_id' => 10,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-25 20:39:11',
                'updated_at' => '2020-05-25 20:39:11',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'story_id' => 11,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-05-28 15:19:04',
                'updated_at' => '2020-05-28 15:19:26',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'story_id' => 12,
                'has_character' => 1,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => 10,
                'created_at' => '2020-05-29 08:35:05',
                'updated_at' => '2020-05-29 08:35:09',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'story_id' => 13,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 9,
                'inventory_slots' => -1,
                'created_at' => '2020-06-02 14:59:05',
                'updated_at' => '2020-06-02 14:59:41',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'story_id' => 14,
                'has_character' => 1,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-06-02 15:03:01',
                'updated_at' => '2020-06-02 15:03:05',
                'deleted_at' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'story_id' => 15,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-06-20 07:41:30',
                'updated_at' => '2020-06-20 07:41:30',
                'deleted_at' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'story_id' => 16,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-06-20 17:07:37',
                'updated_at' => '2020-06-20 17:07:57',
                'deleted_at' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'story_id' => 17,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-06-21 09:51:54',
                'updated_at' => '2020-06-21 09:51:54',
                'deleted_at' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'story_id' => 18,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-06-30 07:05:00',
                'updated_at' => '2020-06-30 07:05:00',
                'deleted_at' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'story_id' => 19,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => 10,
                'created_at' => '2020-07-28 12:55:56',
                'updated_at' => '2020-07-28 12:56:21',
                'deleted_at' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'story_id' => 20,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-08-05 16:41:59',
                'updated_at' => '2020-08-05 16:41:59',
                'deleted_at' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'story_id' => 21,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-08-05 16:42:12',
                'updated_at' => '2020-08-05 16:42:12',
                'deleted_at' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'story_id' => 22,
                'has_character' => 0,
                'has_stats' => 0,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-08-12 13:56:18',
                'updated_at' => '2020-08-12 13:56:18',
                'deleted_at' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'story_id' => 23,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => 7,
                'created_at' => '2020-08-13 04:36:51',
                'updated_at' => '2020-08-13 04:37:14',
                'deleted_at' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'story_id' => 24,
                'has_character' => 1,
                'has_stats' => 1,
                'stat_attribution' => 'player',
                'points_to_share' => 10,
                'inventory_slots' => -1,
                'created_at' => '2020-08-19 02:41:19',
                'updated_at' => '2020-08-19 02:41:36',
                'deleted_at' => NULL,
            ),
        ));


    }
}
