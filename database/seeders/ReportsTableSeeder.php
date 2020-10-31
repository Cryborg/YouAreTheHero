<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('reports')->delete();

        \DB::table('reports')->insert(array (
            0 =>
            array (
                'id' => 1,
                'user_id' => 1,
                'page_id' => 74,
                'error_type' => 'spelling',
                'comment' => 's gsdfg df',
                'created_at' => '2020-06-05 19:41:17',
                'updated_at' => '2020-06-05 19:41:27',
                'deleted_at' => '2020-06-05 19:41:27',
            ),
        ));


    }
}
