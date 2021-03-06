<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'first_name' => 'Marty',
                'last_name' => 'ADMIN',
                'username' => 'Cryborg',
                'email' => 'cryborg@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'Mg1QlknwCOlOXQSy6mrQMQsMR7d0OknU30UGVMRKmDg5oTgrLDK9zp4u95yz',
                'role' => 'admin',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'first_name' => 'Marty',
                'last_name' => 'MODERATOR',
                'username' => 'Cryborg_modo',
                'email' => 'cryborg_modo@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'moderator',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'first_name' => 'Marty',
                'last_name' => 'MEMBER',
                'username' => 'Cryborg_member',
                'email' => 'cryborg_member@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'first_name' => 'Fred',
                'last_name' => 'ADMIN',
                'username' => 'Fred',
                'email' => 'fred_admin@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'admin',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'first_name' => 'Fred',
                'last_name' => 'MODERATOR',
                'username' => 'Fred_modo',
                'email' => 'fred_modo@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'moderator',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'first_name' => 'Fred',
                'last_name' => 'MEMBER',
                'username' => 'Fred_member',
                'email' => 'fred_member@live.fr',
                'password' => '$2y$10$DbdP2HjT0HRyRw5smftYzewPGiuZD9uvhG1TcnD3fd6auYnIdPLk2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Narkhos',
                'email' => 'xavierdirez@hotmail.com',
                'password' => '$2y$10$6cI2Srn9Xc5e0iff3Vh9ieBNbEPWFMIA.5WYry9zVgkq0W3Rioub2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'XXADLJvx9SgzWIrxOkS2QkOQtJqsp5RynqvaY5PZKvLXnzHdxssadJqiSZIg',
                'role' => 'member',
                'created_at' => '2020-01-21 13:43:23',
                'updated_at' => '2020-05-12 13:22:02',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'StephaneF',
                'email' => 'stephane.flauder@gmail.com',
                'password' => '$2y$10$UXPYV19l1midCZEkGxdO6OYg9wFEYei4I8Q85MK4BCd9hZzgMZrB6',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-01-20 05:43:46',
                'updated_at' => '2020-01-20 05:43:46',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'first_name' => 'Frédéric',
                'last_name' => 'Amary',
                'username' => 'darkfred78',
                'email' => 'darkfred78@gmail.com',
                'password' => '$2y$10$0w9jpcLkK.Yl/tesJ1ZoYuMUUyt86yOm45kk1Gau/vxif4D8PuB7K',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'dD6yxRVcWjOoWZNoAGfsZ9CyO5FBfD92wVYIKr0bZovL3oNccUMm7pKOswct',
                'role' => 'moderator',
                'created_at' => '2020-01-20 07:01:28',
                'updated_at' => '2020-04-21 09:33:31',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'misstigris',
                'email' => 'misstigris.puce@gmail.com',
                'password' => '$2y$10$MLSsq99lff0mco85X1UAu.9Z7HtDLq..fgNr.SptKn6oE2QOZsEgi',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'adjQBvLesWDFdy3c6AwdpgRfgR5ipzuANKb2TSRWGefgPWeC0Mpxj0wQwKTO',
                'role' => 'member',
                'created_at' => '2020-01-22 08:50:27',
                'updated_at' => '2020-01-22 08:50:27',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Franchiver',
                'email' => 'benoitsmith.web@elbelion.com',
                'password' => '$2y$10$eY4dpL7hMuDBCpCsnz94WujeGpeZWDCNTZyxQnIRPKFEM31EevnOS',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'KOr9JqwVL9tpIVv576JQyNNwmU9VVWsQGeT5JIRUblfgtDeayxi803UxR29w',
                'role' => 'member',
                'created_at' => '2020-02-05 23:29:38',
                'updated_at' => '2020-02-05 23:29:38',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            11 =>
            array (
                'id' => 12,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 't.beaury@gmail.com',
                'email' => 't.beaury@gmail.com',
                'password' => '$2y$10$MvculUDb/tz7RA8WdzsTg.ngjwXUD/RwzUVwIyJbBw6FR1GfTTm8C',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-03-19 11:01:25',
                'updated_at' => '2020-03-19 11:01:25',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            12 =>
            array (
                'id' => 13,
                'first_name' => 'Elowenn',
                'last_name' => 'Mitaillé',
                'username' => '_elowxnn',
                'email' => 'wennwendmsp@gmail.com',
                'password' => '$2y$10$HbV6cl7EaZaB/pSPWcuOdO8ozJ/GTV1UGNAEOZjPZpNwdqOsWduOO',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'OaMhb4j9smvsaPeGnQY9oovD34StVjf7yeLwJJaDBoNXVwK59aelpgg8caTD',
                'role' => 'member',
                'created_at' => '2020-04-08 12:40:24',
                'updated_at' => '2020-08-05 14:25:02',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            13 =>
            array (
                'id' => 14,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Tatie Scribouillis',
                'email' => 'christelle.pelat@outlook.fr',
                'password' => '$2y$10$wDGVNj50ZOTZo1AWbnIkcu5npI5QfRANPw1hOo6EU3u4Z0NrP0uu6',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-05-17 05:17:19',
                'updated_at' => '2020-05-17 05:17:19',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            14 =>
            array (
                'id' => 15,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'MatO',
                'email' => 'mathilda.bonnant@gmail.com',
                'password' => '$2y$10$Zic17J8xuR3IZFSZvKqD9u00GIpvL1zwd2yYat.YxMOtPirQA7dsq',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-05-23 20:19:29',
                'updated_at' => '2020-05-23 20:19:29',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            15 =>
            array (
                'id' => 16,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'misterobo',
                'email' => 'misterobo@mail.com',
                'password' => '$2y$10$f3r.SnXyprM.QHihmz2uZe6oMVHcldKMSJ8/fZQ28xCZaQmICfuCe',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-05-28 15:18:03',
                'updated_at' => '2020-05-28 15:18:03',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            16 =>
            array (
                'id' => 17,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Nemo',
                'email' => 's.rousset@sfr.fr',
                'password' => '$2y$10$Zcg0AUYKDGN85Bsx0c0HfOM2vGwlRxw1kU7aIm0a.PTue8JkxpH.C',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-06-02 14:52:08',
                'updated_at' => '2020-06-02 14:52:08',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            17 =>
            array (
                'id' => 18,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Isa',
                'email' => 'tivolie5134@gmail.com',
                'password' => '$2y$10$5h.GADgEU33pyYu1PTbAx.DFY9nqAk/JGMvzdcz3LRYMiSvvt2x4i',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-06-20 07:39:45',
                'updated_at' => '2020-06-20 07:39:45',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            18 =>
            array (
                'id' => 19,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'aru',
                'email' => 'aru.sg.fr@gmail.com',
                'password' => '$2y$10$dePyMjXxW.SfqZvHCqGx0O3WtGd6m9PDZejEWIDrUmmd0QlKKU.B2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-06-20 17:06:30',
                'updated_at' => '2020-06-20 17:06:30',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            19 =>
            array (
                'id' => 20,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'pompidop',
                'email' => 'arthur.poloff@gmail.com',
                'password' => '$2y$10$VtsmKXV8NJaiixtx1fKADOm7EqYNYgHvYIGoZymnaKP549XWdGcyS',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-06-30 07:03:26',
                'updated_at' => '2020-06-30 07:03:26',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            20 =>
            array (
                'id' => 21,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'LornMalvo',
                'email' => 'ng73800@gmail.com',
                'password' => '$2y$10$l/S5Y3Q8ye02WrZNQd9IReHDQ4PTLoto8Blrw8JX6soIF5Akv9kCa',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-11 13:02:30',
                'updated_at' => '2020-08-11 13:02:30',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            21 =>
            array (
                'id' => 22,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'MAD5D',
                'email' => 'drouin.marcantoine@gmail.com',
                'password' => '$2y$10$VOCw/WacLtgWVHfYnhKVe.ymMA3Onh5oT6TeOB3aDLsgEfd8t4FXW',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-11 14:08:29',
                'updated_at' => '2020-08-11 14:08:29',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            22 =>
            array (
                'id' => 23,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Yop',
                'email' => 'yop@yop.fr',
                'password' => '$2y$10$olDLjEZMkh/vHVnqcHKpeO1jJ2o.MBtn5Pi7nmz0ZUkcGLVYe.n2m',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-12 08:03:27',
                'updated_at' => '2020-08-12 08:03:27',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            23 =>
            array (
                'id' => 24,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Ulcrim',
                'email' => 'xhgdemonsx@gmail.com',
                'password' => '$2y$10$GZiBx/1kcXfjEyPlt9Gek.CCvSwSadUt8/HjfpUN1NdmrO2OE.VLa',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-12 13:52:56',
                'updated_at' => '2020-08-12 13:52:56',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            24 =>
            array (
                'id' => 25,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'ulgrude',
                'email' => 'ulgrude@yopmail.com',
                'password' => '$2y$10$cRDYIhZh2wuk/qSm2Ww/2ugUhZ3Od0tk8f3UkEmtIuYIXmN/lOuy.',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-12 15:24:07',
                'updated_at' => '2020-08-12 15:24:07',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            25 =>
            array (
                'id' => 26,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Jebvev@jehbe',
                'email' => 'jdhebv@jehhz',
                'password' => '$2y$10$D6NHUZ8Pxyg8yZrduVh4RuLYeElcZJE5PwZnFXGPxYDBRG24sEzDC',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-12 20:46:12',
                'updated_at' => '2020-08-12 20:46:12',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            26 =>
            array (
                'id' => 27,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'deeluxe',
                'email' => 'rollet.raphael@gmail.com',
                'password' => '$2y$10$htFIWE0xZGrEOfyiWH0xC.NJMDzS7kZHZR6BDvR/zYqU78BlaaOHC',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-08-14 07:26:09',
                'updated_at' => '2020-08-14 07:26:09',
                'deleted_at' => NULL,
                'google_id' => NULL,
                'avatar' => NULL,
                'avatar_original' => NULL,
            ),
            27 =>
            array (
                'id' => 29,
                'first_name' => NULL,
                'last_name' => NULL,
                'username' => 'Franck LÉCUVIER',
                'email' => 'cryborg@gmail.com',
                'password' => NULL,
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => 'lChqNzQ2gOKclPYkqDZ8Bv1zpJk7gA7emvFuQfUtV2VsBxMvM9tG5rdnHhP0',
                'role' => 'member',
                'created_at' => '2020-08-14 14:35:43',
                'updated_at' => '2020-08-14 14:35:43',
                'deleted_at' => NULL,
                'google_id' => '116248881235448347145',
                'avatar' => 'https://lh3.googleusercontent.com/a-/AOh14GhnIouXKxuOiuIFDplPhjPvRWMKt1QuW7mlThXFth8',
                'avatar_original' => 'https://lh3.googleusercontent.com/a-/AOh14GhnIouXKxuOiuIFDplPhjPvRWMKt1QuW7mlThXFth8',
            ),
        ));


    }
}
