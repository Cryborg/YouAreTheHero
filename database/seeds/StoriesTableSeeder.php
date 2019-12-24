<?php

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Item;

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

        Story::create(array (
            'id' => 5,
            'title' => 'Emergence',
            'description' => 'Par Alexis Ravel<br>http://litteraction.fr/sites/default/files/emergence_0.pdf',
            'user_id' => 1,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'sheet_config' => NULL,
            'is_published' => 0,
            'created_at' => '2019-12-19 16:29:44',
            'updated_at' => '2019-12-19 16:29:44',
        ));
        Story::create(array (
            'id' => 6,
            'title' => 'Un nouveau départ',
            'description' => "Description de l'histoire",
            'user_id' => 1,
            'locale' => 'fr_FR',
            'layout' => 'play1',
            'sheet_config' => NULL,
            'is_published' => 0,
            'created_at' => '2019-12-19 16:29:44',
            'updated_at' => '2019-12-19 16:29:44',
        ));
    }
}
