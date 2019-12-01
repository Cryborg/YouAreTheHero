<?php

use App\Models\Story;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\PageLink;
use App\Models\Item;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin tables
        $this->call(AdminUsersTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminUserPermissionsTableSeeder::class);

        // Users
        $marty = User::create([
            'first_name'    => 'Marty',
            'last_name'     => 'FRIEDMAN',
            'username'      => 'Cryborg',
            'email'         => 'cryborg@live.fr',
            'password'      => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
            'created_at'    => now(),
        ]);

        $fred = User::create([
            'first_name'    => 'Fred',
            'last_name'     => 'ASTAIR',
            'username'      => 'Fred',
            'email'         => 'fred@live.fr',
            'password'      => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
            'created_at'    => now(),
        ]);

        // Stories
        $sheet = [
            'experience'    => 0,
            'level'         => 1,
            'force'         => 1,
        ];
        $storyMarty = Story::create([
            'title'         => 'Ma guitare et moi',
            'description'   => 'Comment je suis devenu un dieu de la guitare.',
            'user_id'       => $marty->id,
            'created_at'    => now(),
            'is_published'  => true,
            'sheet_config'  => $sheet,
        ]);
        $storyFred = Story::create([
            'title'         => 'Les claquettes de nos jours',
            'description'   => 'Mais pourquoi en suis-je venu à faire des claquettes ?<br>Récit d\'une vie.',
            'user_id'       => $fred->id,
            'created_at'    => now(),
            'is_published'  => true,
            'sheet_config'  => $sheet,
        ]);

        foreach ([$storyMarty, $storyFred] as $story) {
            $p1 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 1',
                'description' => '<p>Premier paragraphe avec une seule option, pas difficile de choisir ;)</p>' .
                    '<p>Mais.... ce marteau pourrait peut-être m\'aider ?</p>',
                'is_first' => true,
            ]);
            $p2 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 2',
                'description' => 'Ca se corse !! Trois choix, dis-donc que c\'est dur...<br>En plus l\'inventaire à gauche s\'est barré...',
                'layout' => 'play2',
            ]);
            PageLink::create([
                 'page_from' => $p1->id,
                 'page_to' => $p2->id,
                 'link_text' => 'Pas le choix, je clique ici !',
            ]);

            $marteau = Item::create([
                'name' => 'Marteau',
                'default_price' => 1,
                'story_id' => $story->id,
                'effects' => [
                    'force' => ['operator' => '+', 'quantity' => 1],
                ]
            ]);
            $p1->addItem([
                'item' => $marteau->id,
                'verb' => 'buy',
                'amount' => $marteau->default_price
            ]);
            $p2_1 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 2.1',
                'description' => 'Bien joué ! C\'est un paragraphe difficile à atteindre :)',
                'prerequisites' => [
                    'sheet' => [
                        'force' => 2
                    ],
                    'items' => [
                        $marteau->id,
                    ]
                ]
            ]);
            PageLink::create([
                'page_from' => $p1->id,
                'page_to' => $p2_1->id,
                'link_text' => 'Casser un mur avec le marteau',
            ]);

            $p3 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 3',
                'description' => 'Je suis allé à gauche et c\'est beau !',
            ]);
            $p4 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 4',
                'description' => 'Je suis allé tout droit, pas mal !',
            ]);
            $p5 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 5',
                'description' => 'Je suis allé à droite, c\'est magnifique !',
            ]);
            PageLink::create([
                'page_from' => $p2->id,
                'page_to' => $p3->id,
                'link_text' => 'Aller à gauche',
            ]);
            PageLink::create([
                'page_from' => $p2->id,
                'page_to' => $p4->id,
                'link_text' => 'Aller tout droit',
            ]);
            PageLink::create([
                'page_from' => $p2->id,
                'page_to' => $p5->id,
                'link_text' => 'Aller à droite',
            ]);
            PageLink::create([
                'page_from' => $p2_1->id,
                'page_to' => $p5->id,
                'link_text' => 'On continue !',
            ]);

            $p6 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 5',
                'description' => 'Tous les chemins mènent ici, aucun mérite !',
                'is_last' => true,
            ]);
            PageLink::create([
                'page_from' => $p3->id,
                'page_to' => $p6->id,
                'link_text' => 'Tout droit !',
            ]);
            PageLink::create([
                'page_from' => $p5->id,
                'page_to' => $p6->id,
                'link_text' => 'C\'est parti mon kiki !',
            ]);

            $p7 = $this->addPage($story, $p4, [
                'title' => 'Paragraphe 5',
                'description' => 'The lieutenant commander is more particle now than planet. interstellar and wildly intelligent!'
                    . '<br>Fly without powerdrain, and we won’t love an astronaut.'
                    . '<br><br><br>Congratulations you WON!!',
                'link_text' => 'Je continue d\'avancer !',
            ]);
            $p8 = $this->addPage($story, $p4, [
                'title' => 'Paragraphe 6',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Irai-je à gauche ?',
            ]);
            $p9 = $this->addPage($story, $p4, [
                'title' => 'Paragraphe 7',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Ou au milieu ?',
            ]);
            $p10 = $this->addPage($story, $p4, [
                'title' => 'Paragraphe 8',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Ou bien à droite ?',
            ]);

            // Create some items
            $items = [
                'Epée rouillée', 'Bouclier du pauvre', 'Jambières de fillette', 'Gants délicats',
                'Cotte de mouille', 'Epoulettes', 'Casque efféminé', 'Pantoufles de verre',
                'Vif d\'or (plaqué)', 'Pain de campagne magique'
            ];
            foreach ($items as $item) {
                $price = round(rand(1, 5));
                $itemStuff = [
                    'name' => $item,
                    'default_price' => $price,
                    'story_id' => $story->id,
                ];

                switch ($price) {
                    case 1:
                        $itemStuff['effects'] = [
                            'experience' => ['operator' => '-', 'quantity' => 2],
                        ];
                        break;
                    case 2:
                        $itemStuff['effects'] = [
                             'force' => ['operator' => '-', 'quantity' => 1],
                        ];
                        break;
                    case 3:
                        $itemStuff['effects'] = [
                            'level' => ['operator' => '*', 'quantity' => 2],
                        ];
                        break;
                    case 4:
                        $itemStuff['effects'] = [
                            'level' => ['operator' => '+', 'quantity' => 2],
                            'exp' => ['operator' => '/', 'quantity' => 2],
                        ];
                        break;
                    case 5:
                        $itemStuff['effects'] = [
                            'experience' => ['operator' => '+', 'quantity' => 10],
                            'force' => ['operator' => '+', 'quantity' => 1],
                            'level' => ['operator' => '+', 'quantity' => 1],
                        ];
                        break;
                }

                $newItem = Item::create($itemStuff);

                // Put some items to pick in one of the pages
                /** @var \App\Models\Page $page */
                $page = Page::where('id', $p6->id)->first();
                $page->addItem([
                   'item' => $newItem->id,
                   'verb' => 'buy',
                   'amount' => $newItem->default_price
                ]);
                $this->call(AdminRolesTableSeeder::class);
    }

            // Put a purse with money in it
            $newItem = Item::create([
                'name' => 'Porte-monnaie perdu (exp +10)',
                'default_price' => 8,
                'story_id' => $story->id,
                'single_use' => true,
                'effects' => ['experience' => ['operator' => '+', 'quantity' => 10]]
            ]);

            // Put some items to pick in one of the pages
            /** @var \App\Models\Page $page */
            $page = Page::where('id', $p6->id)->first();
            $page->addItem([
               'item' => $newItem->id,
               'verb' => 'earn',
               'amount' => $newItem->default_price
           ]);

            // Genres
            $genres = ['science-fiction', 'romance', 'policier', 'thriller', 'epouvante', 'comedie', 'drame',
                'biographie'];
            $aGenres = [];
            foreach ($genres as $genre) {
                $aGenres[] = \App\Models\Genre::create([
                    'label' => $genre,
                ]);
            }

            \App\Models\StoryGenre::create([
                'story_id' => $story->id,
                'genre_id' => $aGenres[count($aGenres) - 1]->id,
             ]);
        }
    }

    private function addPage(Story $story, Page $after, $data) {
        $new = Page::create([
            'story_id' => $story->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'is_last' => $data['is_last'] ?? false,
        ]);
        PageLink::create([
            'page_from' => $after->id,
            'page_to' => $new->id,
            'link_text' => $data['link_text'],
        ]);

        return $new;
    }
}

