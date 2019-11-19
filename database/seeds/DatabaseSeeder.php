<?php

use App\Models\Story;
use Illuminate\Database\Seeder;
use App\User;
use App\Models\Paragraph;
use App\Models\Paragraph_link;

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

        foreach ([$storyMarty, $storyFred] as $story) {
            $p1 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 1',
                'description' => 'Premier paragraphe avec une seule option, pas difficile de choisir ;)',
                'is_first' => true,
            ]);
            $p2 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 2',
                'description' => 'Ca se corse !! Trois choix, dis-donc que c\'est dur...<br>En plus l\'inventaire à gauche s\'est barré...',
                'layout' => 'play2',
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p1->id,
                'paragraph_to' => $p2->id,
                'link_text' => 'Pas le choix, je clique ici !',
            ]);

            $p3 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 3',
                'description' => 'Je suis allé à gauche et c\'est beau !',
            ]);
            $p4 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 4',
                'description' => 'Je suis allé tout droit, pas mal !',
            ]);
            $p5 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 5',
                'description' => 'Je suis allé à droite, c\'est magnifique !',
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p2->id,
                'paragraph_to' => $p3->id,
                'link_text' => 'Aller à gauche',
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p2->id,
                'paragraph_to' => $p4->id,
                'link_text' => 'Aller tout droit',
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p2->id,
                'paragraph_to' => $p5->id,
                'link_text' => 'Aller à droite',
            ]);

            $p6 = Paragraph::create([
                'story_id' => $story->id,
                'title' => 'Paragraphe 5',
                'description' => 'Tous les chemins mènent ici, aucun mérite !',
                'is_last' => true,
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p3->id,
                'paragraph_to' => $p6->id,
                'link_text' => 'Tout droit !',
            ]);
            Paragraph_link::create([
                'paragraph_from' => $p5->id,
                'paragraph_to' => $p6->id,
                'link_text' => 'C\'est parti mon kiki !',
            ]);

            $p6 = $this->addParagraph($story, $p4, [
                'title' => 'Paragraphe 5',
                'description' => 'The lieutenant commander is more particle now than planet. interstellar and wildly intelligent!'
                    . '<br>Fly without powerdrain, and we won’t love an astronaut.'
                    . '<br><br><br>Congratulations you WON!!',
                'link_text' => 'Je continue d\'avancer !',
            ]);
            $p8 = $this->addParagraph($story, $p4, [
                'title' => 'Paragraphe 6',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Irai-je à gauche ?',
            ]);
            $p9 = $this->addParagraph($story, $p4, [
                'title' => 'Paragraphe 7',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Ou au milieu ?',
            ]);
            $p10 = $this->addParagraph($story, $p4, [
                'title' => 'Paragraphe 8',
                'description' => 'Tu as bien choisi, tu es arrivé bien loin !',
                'link_text' => 'Ou bien à droite ?',
            ]);
        }
    }

    private function addParagraph(Story $story, Paragraph $after, $data) {
        $new = Paragraph::create([
            'story_id' => $story->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'is_last' => $data['is_last'] ?? false,
        ]);
        Paragraph_link::create([
            'paragraph_from' => $after->id,
            'paragraph_to' => $new->id,
            'link_text' => $data['link_text'],
        ]);

        return $new;
    }
}

