<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Story;
use App\User;
use App\User_story;
use App\Paragraph;
use App\Paragraph_link;

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

        // First chapters
        $p1 = Paragraph::create([
            'title' => 'Paragraphe 1',
            'description' => 'Dosis warp with friendship at the twisted ready room!<br>I raise this life, it\'s called galactic ellipse.',
        ]);
        $p2 = Paragraph::create([
            'title' => 'Paragraphe 2',
            'description' => 'Cum bulla unda, omnes abaculuses experientia noster, gratis musaes!<br>Rusticus, grandis tuss patienter imperium de superbus, fortis gemna.',
        ]);
        Paragraph_link::create([
            'paragraph_from' => $p1,
            'paragraph_to' => $p2,
            'link_text' => 'Aller au chapitre 2',
        ]);

        // Choices
        $p3 = Paragraph::create([
            'title' => 'Paragraphe 3',
            'description' => 'Moons, explosion of the blessings, and strange individuals will always protect them!<br>To some, a thing is a peace for illuminating.',
        ]);
        $p4 = Paragraph::create([
            'title' => 'Paragraphe 4',
            'description' => 'The wind sails with courage, desire the captain\'s quarters before it hobbles!<br>Weird, warm anchors cruelly lead a gutless, salty whale.',
        ]);
        Paragraph_link::create([
            'paragraph_from' => $p2,
            'paragraph_to' => $p3,
            'link_text' => 'Aller au chapitre 3',
        ]);
        Paragraph_link::create([
            'paragraph_from' => $p2,
            'paragraph_to' => $p4,
            'link_text' => 'Aller au chapitre 4',
        ]);

        // Final chapter
        $p5 = Paragraph::create([
            'title' => 'Paragraphe 5',
            'description' => 'The lieutenant commander is more particle now than planet. interstellar and wildly intelligent!<br>Fly without powerdrain, and we won’t love an astronaut.',
            'is_last' => true,
        ]);
        Paragraph_link::create([
            'paragraph_from' => $p3,
            'paragraph_to' => $p5,
            'link_text' => 'Aller au chapitre 3',
        ]);
        Paragraph_link::create([
            'paragraph_from' => $p4,
            'paragraph_to' => $p5,
            'link_text' => 'Aller au chapitre 4',
        ]);
    }
}

