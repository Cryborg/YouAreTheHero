<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Story;
use App\User;
use App\User_story;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users
        $marty = User::create([
            'first_name'    => 'Marty',
            'last_name'     => 'FRIEDMAN',
            'password'      => sha1('a'),
            'created_at'    => now(),
        ]);

        $fred = User::create([
            'first_name'    => 'Fred',
            'last_name'     => 'ASTAIR',
            'password'      => sha1('a'),
            'created_at'    => now(),
        ]);

        factory(App\Story::class, 10)->create();
    }
}
