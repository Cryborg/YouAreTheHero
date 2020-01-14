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
        // Admin tables
//        $this->call(AdminUsersTableSeeder::class);
//        $this->call(AdminMenuTableSeeder::class);
//        $this->call(AdminPermissionsTableSeeder::class);
//        $this->call(AdminRoleMenuTableSeeder::class);
//        $this->call(AdminRolePermissionsTableSeeder::class);
//        $this->call(AdminRoleUsersTableSeeder::class);
//        $this->call(AdminUserPermissionsTableSeeder::class);
//        $this->call(AdminRolesTableSeeder::class);

        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        //TODO: remove this once in prod ;)
        \Illuminate\Support\Facades\Artisan::call('dev:generate');
        $this->call(StoriesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PageLinkTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(CharactersTableSeeder::class);
        $this->call(StatStoryTableSeeder::class);
        $this->call(StatsTableSeeder::class);
        $this->call(PrerequisitesTableSeeder::class);
        $this->call(GenresTableSeeder::class);
    }
}

