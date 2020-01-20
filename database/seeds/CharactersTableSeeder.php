<?php

use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('characters')->delete();

        \DB::table('characters')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Cryborg',
                'user_id' => 1,
                'story_id' => 1,
                'page_uuid' => '8e32b39a-0886-37f3-93fd-f606a88950a9',
                'money' => 10,
                'created_at' => '2020-01-10 23:13:36',
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));


    }
}
