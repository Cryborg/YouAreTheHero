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
        $marty = User::firstOrCreate([
                'email'      => 'cryborg@live.fr',
            ], [
                'first_name' => 'Marty',
                'last_name'  => 'FRIEDMAN',
                'username'   => 'Cryborg',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
            ]
        );

        $fred = User::firstOrCreate([
                'email'      => 'fred@live.fr',
            ], [
                'first_name' => 'Fred',
                'last_name'  => 'ASTAIR',
                'username'   => 'Fred',
                'password'   => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
            ]
        );
return true;
        // Stories
        $sheet = [
            'experience' => 0,
            'level'      => 1,
            'force'      => 1,
        ];

        $storyMarty = factory(Story::class)->create([
            'user_id'       => $marty->id,
        ]);
        $storyFred = factory(Story::class)->create([
            'user_id'       => $fred->id,
        ]);

        $stories = [
            $storyMarty,
            $storyFred,
        ];

        foreach ($stories as $story) {
            /** @var \App\Models\Page[] $pages */
            $pages = factory(Page::class, 11)->create([
                    'story_id' => $story->id,
                ]
            );

            PageLink::create([
                    'page_from' => $pages[0]->id,
                    'page_to'   => $pages[1]->id,
                    'link_text' => 'Pas le choix, je clique ici !',
                ]
            );

            $marteau = Item::create([
                    'name'          => 'Marteau',
                    'default_price' => 1,
                    'story_id'      => $story->id,
                    'single_use'    => true,
                ]
            );

            $pages[0]->addAction([
                    'item_id'  => $marteau->id,
                    'verb'     => 'buy',
                    'quantity' => $marteau->default_price,
                ]
            );

            $pages[10] = factory(Page::class)->create([
                    'story_id' => $story->id,
                ]
            );
            PageLink::create([
                    'page_from' => $pages[0]->id,
                    'page_to'   => $pages[10]->id,
                    'link_text' => 'Casser un mur avec le marteau',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[1]->id,
                    'page_to'   => $pages[2]->id,
                    'link_text' => 'Aller à gauche',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[1]->id,
                    'page_to'   => $pages[3]->id,
                    'link_text' => 'Aller tout droit',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[1]->id,
                    'page_to'   => $pages[4]->id,
                    'link_text' => 'Aller à droite',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[10]->id,
                    'page_to'   => $pages[4]->id,
                    'link_text' => 'On continue !',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[2]->id,
                    'page_to'   => $pages[5]->id,
                    'link_text' => 'Tout droit !',
                ]
            );
            PageLink::create([
                    'page_from' => $pages[4]->id,
                    'page_to'   => $pages[5]->id,
                    'link_text' => 'C\'est parti mon kiki !',
                ]
            );

            // Create some items
            $items = [
                'Epée rouillée',
                'Bouclier du pauvre',
                'Jambières de fillette',
                'Gants délicats',
                'Cotte de mouille',
                'Epoulettes',
                'Casque efféminé',
                'Pantoufles de verre',
                'Vif d\'or (plaqué)',
                'Pain de campagne magique',
            ];
            foreach ($items as $item) {
                $price     = round(rand(1, 5));
                $itemStuff = [
                    'name'          => $item,
                    'default_price' => $price,
                    'story_id'      => $story->id,
                ];

                $newItem = Item::create($itemStuff);

                // Put some items to pick in one of the pages
                $pages[5]->addAction([
                        'item_id'  => $newItem->id,
                        'verb'     => 'buy',
                        'quantity' => $newItem->default_price,
                    ]
                );
            }

            // Put a purse with money in it
            $newItem = Item::create([
                    'name'          => 'Porte-monnaie perdu',
                    'default_price' => 8,
                    'story_id'      => $story->id,
                    'single_use'    => true,
                ]
            );

            $pages[5]->addAction([
                    'item_id'  => $newItem->id,
                    'verb'     => 'earn',
                    'quantity' => $newItem->default_price,
                ]
            );

            // Genres
            $genres  = [
                'science-fiction',
                'romance',
                'policier',
                'thriller',
                'epouvante',
                'comedie',
                'drame',
                'biographie',
            ];
            $aGenres = [];
            foreach ($genres as $genre) {
                $aGenres[] = Genre::create([
                        'label' => $genre,
                    ]
                );
            }

            StoryGenre::create([
                    'story_id' => $story->id,
                    'genre_id' => $aGenres[count($aGenres) - 1]->id,
                ]
            );
        }
    }
}
