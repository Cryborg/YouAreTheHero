<?php

use App\Models\Genre;
use App\Models\Story;
use App\Models\StoryGenre;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\PageLink;
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
        $this->call(PageLinkTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(CharactersTableSeeder::class);
        $this->call(StatStoryTableSeeder::class);
        $this->call(CharacterStatsTableSeeder::class);
        $this->call(PrerequisitesTableSeeder::class);
        $this->call(StatsTableSeeder::class);
    }
}

