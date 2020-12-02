<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('successes')->insert([
            [
                'title' => 'first_story_created',
            ],
            [
                'title' => 'first_story_published',
            ],
        ]);

    }
}
