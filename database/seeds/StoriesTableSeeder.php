<?php

use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('stories')->delete();

        \DB::table('stories')->insert(array (
                                          1 =>
                                              array (
                                                  'id' => 2,
                                                  'title' => 'Un nouveau départ',
                                                  'description' => 'Description de l\'histoire',
                                                  'user_id' => 1,
                                                  'locale' => 'fr_FR',
                                                  'layout' => 'play1',
                                                  'is_published' => 0,
                                                  'created_at' => '2019-11-12 16:29:44',
                                                  'updated_at' => '2020-01-02 16:29:44',
                                              ),
                                      ));
    }
}
