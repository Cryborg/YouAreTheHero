<?php

namespace App\Console\Commands;

use App\Models\Genre;
use App\Models\Item;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Story;
use App\Models\StoryGenre;
use App\Models\User;
use Illuminate\Console\Command;

class DevGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates dummy data for dev testing';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO: use more factories

        // Users
        User::firstOrCreate([
                'email'      => 'cryborg@live.fr',
            ], [
                'first_name' => 'Marty',
                'last_name'  => 'ADMIN',
                'username'   => 'Cryborg',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'admin',
            ]
        );
        User::firstOrCreate([
                'email'      => 'cryborg_modo@live.fr',
            ], [
                'first_name' => 'Marty',
                'last_name'  => 'MODERATOR',
                'username'   => 'Cryborg_modo',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'moderator',
            ]
        );
        User::firstOrCreate([
                'email'      => 'cryborg_member@live.fr',
            ], [
                'first_name' => 'Marty',
                'last_name'  => 'MEMBER',
                'username'   => 'Cryborg_member',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'member',
            ]
        );

        User::firstOrCreate([
                'email'      => 'fred_admin@live.fr',
            ], [
                'first_name' => 'Fred',
                'last_name'  => 'ADMIN',
                'username'   => 'Fred',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'admin',
            ]
        );
        User::firstOrCreate([
                'email'      => 'fred_modo@live.fr',
            ], [
                'first_name' => 'Fred',
                'last_name'  => 'MODERATOR',
                'username'   => 'Fred_modo',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'moderator',
            ]
        );
        User::firstOrCreate([
                'email'      => 'fred_member@live.fr',
            ], [
                'first_name' => 'Fred',
                'last_name'  => 'MEMBER',
                'username'   => 'Fred_member',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'role'       => 'member',
            ]
        );
    }
}
