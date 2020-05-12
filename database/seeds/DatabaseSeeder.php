<?php

use App\Models\Genre;
use App\Models\Story;
use App\Models\StoryGenre;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Choices;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        $this->call(GenresTableSeeder::class);

        //TODO: remove this once in prod ;)
        \Illuminate\Support\Facades\Artisan::call('dev:generate');
        $this->call(StoriesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ChoicesTableSeeder::class);
    }
}

