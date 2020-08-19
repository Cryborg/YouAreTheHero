<?php

use Illuminate\Database\Seeder;

class ActivityLogTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activity_log')->delete();
        
        \DB::table('activity_log')->insert(array (
            0 => 
            array (
                'id' => 0,
                'log_name' => 'new_game',
                'description' => 'new game',
                'subject_id' => 23,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 28,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 14:09:59',
                'updated_at' => '2020-08-14 14:09:59',
            ),
            1 => 
            array (
                'id' => 45,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 04:49:59',
                'updated_at' => '2020-08-07 04:49:59',
            ),
            2 => 
            array (
                'id' => 46,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 04:50:23',
                'updated_at' => '2020-08-07 04:50:23',
            ),
            3 => 
            array (
                'id' => 47,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:06',
                'updated_at' => '2020-08-07 05:12:06',
            ),
            4 => 
            array (
                'id' => 48,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:08',
                'updated_at' => '2020-08-07 05:12:08',
            ),
            5 => 
            array (
                'id' => 49,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:12',
                'updated_at' => '2020-08-07 05:12:12',
            ),
            6 => 
            array (
                'id' => 50,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:15',
                'updated_at' => '2020-08-07 05:12:15',
            ),
            7 => 
            array (
                'id' => 51,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:19',
                'updated_at' => '2020-08-07 05:12:19',
            ),
            8 => 
            array (
                'id' => 52,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:23',
                'updated_at' => '2020-08-07 05:12:23',
            ),
            9 => 
            array (
                'id' => 53,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:25',
                'updated_at' => '2020-08-07 05:12:25',
            ),
            10 => 
            array (
                'id' => 54,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-07 05:12:28',
                'updated_at' => '2020-08-07 05:12:28',
            ),
            11 => 
            array (
                'id' => 57,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 21,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 13:02:34',
                'updated_at' => '2020-08-11 13:02:34',
            ),
            12 => 
            array (
                'id' => 58,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 21,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 13:02:47',
                'updated_at' => '2020-08-11 13:02:47',
            ),
            13 => 
            array (
                'id' => 59,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 21,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 13:02:50',
                'updated_at' => '2020-08-11 13:02:50',
            ),
            14 => 
            array (
                'id' => 60,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:08:33',
                'updated_at' => '2020-08-11 14:08:33',
            ),
            15 => 
            array (
                'id' => 61,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:08:52',
                'updated_at' => '2020-08-11 14:08:52',
            ),
            16 => 
            array (
                'id' => 62,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:04',
                'updated_at' => '2020-08-11 14:09:04',
            ),
            17 => 
            array (
                'id' => 63,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:06',
                'updated_at' => '2020-08-11 14:09:06',
            ),
            18 => 
            array (
                'id' => 64,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:09',
                'updated_at' => '2020-08-11 14:09:09',
            ),
            19 => 
            array (
                'id' => 65,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:16',
                'updated_at' => '2020-08-11 14:09:16',
            ),
            20 => 
            array (
                'id' => 66,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:18',
                'updated_at' => '2020-08-11 14:09:18',
            ),
            21 => 
            array (
                'id' => 67,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:19',
                'updated_at' => '2020-08-11 14:09:19',
            ),
            22 => 
            array (
                'id' => 68,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 22,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-11 14:09:27',
                'updated_at' => '2020-08-11 14:09:27',
            ),
            23 => 
            array (
                'id' => 69,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:02',
                'updated_at' => '2020-08-12 13:53:02',
            ),
            24 => 
            array (
                'id' => 70,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:10',
                'updated_at' => '2020-08-12 13:53:10',
            ),
            25 => 
            array (
                'id' => 71,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:15',
                'updated_at' => '2020-08-12 13:53:15',
            ),
            26 => 
            array (
                'id' => 72,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:18',
                'updated_at' => '2020-08-12 13:53:18',
            ),
            27 => 
            array (
                'id' => 73,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:28',
                'updated_at' => '2020-08-12 13:53:28',
            ),
            28 => 
            array (
                'id' => 74,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:35',
                'updated_at' => '2020-08-12 13:53:35',
            ),
            29 => 
            array (
                'id' => 75,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:37',
                'updated_at' => '2020-08-12 13:53:37',
            ),
            30 => 
            array (
                'id' => 76,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:39',
                'updated_at' => '2020-08-12 13:53:39',
            ),
            31 => 
            array (
                'id' => 77,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:44',
                'updated_at' => '2020-08-12 13:53:44',
            ),
            32 => 
            array (
                'id' => 78,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:46',
                'updated_at' => '2020-08-12 13:53:46',
            ),
            33 => 
            array (
                'id' => 79,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 24,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 13:53:52',
                'updated_at' => '2020-08-12 13:53:52',
            ),
            34 => 
            array (
                'id' => 80,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:24:18',
                'updated_at' => '2020-08-12 15:24:18',
            ),
            35 => 
            array (
                'id' => 81,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:01',
                'updated_at' => '2020-08-12 15:25:01',
            ),
            36 => 
            array (
                'id' => 82,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:12',
                'updated_at' => '2020-08-12 15:25:12',
            ),
            37 => 
            array (
                'id' => 83,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:15',
                'updated_at' => '2020-08-12 15:25:15',
            ),
            38 => 
            array (
                'id' => 84,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:17',
                'updated_at' => '2020-08-12 15:25:17',
            ),
            39 => 
            array (
                'id' => 85,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:22',
                'updated_at' => '2020-08-12 15:25:22',
            ),
            40 => 
            array (
                'id' => 86,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:25',
                'updated_at' => '2020-08-12 15:25:25',
            ),
            41 => 
            array (
                'id' => 87,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:27',
                'updated_at' => '2020-08-12 15:25:27',
            ),
            42 => 
            array (
                'id' => 88,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:28',
                'updated_at' => '2020-08-12 15:25:28',
            ),
            43 => 
            array (
                'id' => 89,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:30',
                'updated_at' => '2020-08-12 15:25:30',
            ),
            44 => 
            array (
                'id' => 90,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:32',
                'updated_at' => '2020-08-12 15:25:32',
            ),
            45 => 
            array (
                'id' => 91,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:25:51',
                'updated_at' => '2020-08-12 15:25:51',
            ),
            46 => 
            array (
                'id' => 92,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:01',
                'updated_at' => '2020-08-12 15:26:01',
            ),
            47 => 
            array (
                'id' => 93,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:05',
                'updated_at' => '2020-08-12 15:26:05',
            ),
            48 => 
            array (
                'id' => 94,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:06',
                'updated_at' => '2020-08-12 15:26:06',
            ),
            49 => 
            array (
                'id' => 95,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:08',
                'updated_at' => '2020-08-12 15:26:08',
            ),
            50 => 
            array (
                'id' => 96,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:10',
                'updated_at' => '2020-08-12 15:26:10',
            ),
            51 => 
            array (
                'id' => 97,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:12',
                'updated_at' => '2020-08-12 15:26:12',
            ),
            52 => 
            array (
                'id' => 98,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:13',
                'updated_at' => '2020-08-12 15:26:13',
            ),
            53 => 
            array (
                'id' => 99,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:15',
                'updated_at' => '2020-08-12 15:26:15',
            ),
            54 => 
            array (
                'id' => 100,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 25,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-12 15:26:24',
                'updated_at' => '2020-08-12 15:26:24',
            ),
            55 => 
            array (
                'id' => 155,
                'log_name' => 'new_game',
                'description' => 'New game started',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 27,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 07:26:20',
                'updated_at' => '2020-08-14 07:26:20',
            ),
            56 => 
            array (
                'id' => 156,
                'log_name' => 'end_game',
                'description' => 'finished',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 27,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 07:27:13',
                'updated_at' => '2020-08-14 07:27:13',
            ),
            57 => 
            array (
                'id' => 157,
                'log_name' => 'reset_game',
                'description' => 'reset',
                'subject_id' => 11,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 27,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 07:27:23',
                'updated_at' => '2020-08-14 07:27:23',
            ),
            58 => 
            array (
                'id' => 162,
                'log_name' => 'dead_end',
                'description' => 'The player has nowhere to go!',
                'subject_id' => 168,
                'subject_type' => 'page',
                'causer_id' => 28,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 14:09:42',
                'updated_at' => '2020-08-14 14:09:42',
            ),
            59 => 
            array (
                'id' => 163,
                'log_name' => 'dead_end',
                'description' => 'The player has nowhere to go!',
                'subject_id' => 168,
                'subject_type' => 'page',
                'causer_id' => 28,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 14:09:49',
                'updated_at' => '2020-08-14 14:09:49',
            ),
            60 => 
            array (
                'id' => 164,
                'log_name' => 'dead_end',
                'description' => 'The player has nowhere to go!',
                'subject_id' => 168,
                'subject_type' => 'page',
                'causer_id' => 28,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 14:09:50',
                'updated_at' => '2020-08-14 14:09:50',
            ),
            61 => 
            array (
                'id' => 172,
                'log_name' => 'end_game',
                'description' => 'end game',
                'subject_id' => 23,
                'subject_type' => 'App\\Models\\Story',
                'causer_id' => 28,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-14 14:09:59',
                'updated_at' => '2020-08-14 14:09:59',
            ),
            62 => 
            array (
                'id' => 173,
                'log_name' => 'dead_end',
                'description' => 'The player has nowhere to go!',
                'subject_id' => 168,
                'subject_type' => 'page',
                'causer_id' => 13,
                'causer_type' => 'App\\Models\\User',
                'properties' => '[]',
                'created_at' => '2020-08-16 08:16:14',
                'updated_at' => '2020-08-16 08:16:14',
            ),
        ));
        
        
    }
}