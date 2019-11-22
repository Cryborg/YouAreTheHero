<?php

use App\Models\Story;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Page_link;
use App\Models\Item;

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

        // Stories
        $storyMarty = Story::create([
            'title'         => 'Ma guitare et moi',
            'description'   => 'Comment je suis devenu un dieu de la guitare.',
            'user_id'       => $marty->id,
            'created_at'    => now(),
        ]);
        $storyFred = Story::create([
            'title'         => 'Les claquettes de nos jours',
            'description'   => 'Mais pourquoi en suis-je venu à faire des claquettes ?<br>Récit d\'une vie.',
            'user_id'       => $fred->id,
            'created_at'    => now(),
        ]);
/*
        foreach ([$storyMarty, $storyFred] as $story) {
            $p1 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 1',
                'description' => 'Premier paragraphe avec une seule option, pas difficile de choisir ;)',
                'is_first' => true,
            ]);
            $p2 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 2',
                'description' => 'Ca se corse !! Trois choix, dis-donc que c\'est dur...<br>En plus l\'inventaire à gauche s\'est barré...',
                'layout' => 'play2',
            ]);
            Page_link::create([
                'page_from' => $p1->id,
                'page_to' => $p2->id,
                'link_text' => 'Pas le choix, je clique ici !',
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
            Page_link::create([
                'page_from' => $p2->id,
                'page_to' => $p3->id,
                'link_text' => 'Aller à gauche',
            ]);
            Page_link::create([
                'page_from' => $p2->id,
                'page_to' => $p4->id,
                'link_text' => 'Aller tout droit',
            ]);
            Page_link::create([
                'page_from' => $p2->id,
                'page_to' => $p5->id,
                'link_text' => 'Aller à droite',
            ]);

            $p6 = Page::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 5',
                'description' => 'Tous les chemins mènent ici, aucun mérite !',
                'is_last' => true,
            ]);
            Page_link::create([
                'page_from' => $p3->id,
                'page_to' => $p6->id,
                'link_text' => 'Tout droit !',
            ]);
            Page_link::create([
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
                $newItem = Item::create([
                    'name' => $item,
                    'default_price' => round(rand(1, 5)),
                    'story_id' => $story->id,
                ]);

                // Put some random items to buy in one of the pages
                if (rand(1, 3) < 2) {
                    $page = Page::where('id', $p6->id)->first();
                    $pageItems = $page->items ?? [];
                    $page->update(['items' => array_merge($pageItems, [[
                        'item' => $newItem->id,
                        'verb' => 'buy',
                        'amount' => $newItem->default_price
                    ]])]);
                }
            }
        } */
    }

    private function addPage(Story $story, Page $after, $data) {
        $new = Page::create([
            'story_id' => $story->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'is_last' => $data['is_last'] ?? false,
        ]);
        Page_link::create([
            'page_from' => $after->id,
            'page_to' => $new->id,
            'link_text' => $data['link_text'],
        ]);

        return $new;
    }
}

