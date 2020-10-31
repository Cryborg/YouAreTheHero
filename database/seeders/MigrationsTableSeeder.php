<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('migrations')->delete();

        \DB::table('migrations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'migration' => '2014_04_02_193005_create_translations_table',
                'batch' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'migration' => '2018_08_08_100000_create_telescope_entries_table',
                'batch' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'migration' => '2019_01_01_021232_create_password_resets_table',
                'batch' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'migration' => '2019_11_15_151227_create_users_table',
                'batch' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'migration' => '2019_11_15_151717_create_stories_table',
                'batch' => 1,
            ),
            5 =>
            array (
                'id' => 6,
                'migration' => '2019_11_15_151747_create_pages_table',
                'batch' => 1,
            ),
            6 =>
            array (
                'id' => 7,
                'migration' => '2019_11_15_151757_create_characters_table',
                'batch' => 1,
            ),
            7 =>
            array (
                'id' => 8,
                'migration' => '2019_11_15_153732_create_choices_table',
                'batch' => 1,
            ),
            8 =>
            array (
                'id' => 9,
                'migration' => '2019_11_20_132659_create_items_table',
                'batch' => 1,
            ),
            9 =>
            array (
                'id' => 10,
                'migration' => '2019_11_20_132700_create_field_table',
                'batch' => 1,
            ),
            10 =>
            array (
                'id' => 11,
                'migration' => '2019_11_20_132701_create_effects_table',
                'batch' => 1,
            ),
            11 =>
            array (
                'id' => 12,
                'migration' => '2019_11_23_200627_create_inventories_table',
                'batch' => 1,
            ),
            12 =>
            array (
                'id' => 13,
                'migration' => '2019_11_26_100041_create_character_page_table',
                'batch' => 1,
            ),
            13 =>
            array (
                'id' => 14,
                'migration' => '2019_11_26_101814_create_character_item_table',
                'batch' => 1,
            ),
            14 =>
            array (
                'id' => 15,
                'migration' => '2019_11_27_182145_create_genres_table',
                'batch' => 1,
            ),
            15 =>
            array (
                'id' => 16,
                'migration' => '2019_11_27_182435_create_story_genre_table',
                'batch' => 1,
            ),
            16 =>
            array (
                'id' => 17,
                'migration' => '2019_12_09_142743_create_item_page_table',
                'batch' => 1,
            ),
            17 =>
            array (
                'id' => 18,
                'migration' => '2020_01_06_085231_create_prerequisites_table',
                'batch' => 1,
            ),
            18 =>
            array (
                'id' => 19,
                'migration' => '2020_01_06_090024_create_character_field_table',
                'batch' => 1,
            ),
            19 =>
            array (
                'id' => 20,
                'migration' => '2020_01_22_150252_create_story_option_table',
                'batch' => 1,
            ),
            20 =>
            array (
                'id' => 21,
                'migration' => '2020_04_09_125045_create_riddles_table',
                'batch' => 1,
            ),
            21 =>
            array (
                'id' => 22,
                'migration' => '2020_04_13_144124_create_character_riddle_table',
                'batch' => 1,
            ),
            22 =>
            array (
                'id' => 23,
                'migration' => '2020_05_14_121958_create_activity_log_table',
                'batch' => 1,
            ),
            23 =>
            array (
                'id' => 24,
                'migration' => '2020_05_18_202653_create_descriptions_table',
                'batch' => 1,
            ),
        ));


    }
}
