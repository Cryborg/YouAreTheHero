<?php

use App\Models\Genre;
use App\Models\Story;
use App\Models\StoryGenre;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Choice;
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
        $this->call(UsersTableSeeder::class);
        $this->call(StoriesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ChoicesTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(PrerequisitesTableSeeder::class);
        $this->call(RiddlesTableSeeder::class);
        $this->call(StoryGenreTableSeeder::class);
        $this->call(StoryOptionsTableSeeder::class);
        $this->call(DescriptionsTableSeeder::class);
        $this->call(CharactersTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(ActionCharacterTableSeeder::class);
        $this->call(ActivityLogTableSeeder::class);
        $this->call(CharacterFieldTableSeeder::class);
        $this->call(CharacterItemTableSeeder::class);
        $this->call(CharacterPageTableSeeder::class);
        $this->call(CharacterRiddleTableSeeder::class);
        $this->call(EffectsTableSeeder::class);
        $this->call(ItemPageTableSeeder::class);
        $this->call(LtmTranslationsTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}

