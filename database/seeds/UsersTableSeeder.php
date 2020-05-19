<?php

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
                'remember_token' => 'i8469xCjYoiFBq7ppAwb4xB6ENqqAc2u7rJnR0bHZ9r5Jk7736SpMBmVn3gV',
                'role' => 'admin',
                'created_at' => '2020-05-12 14:50:25',
                'updated_at' => '2020-05-12 14:50:25',
                'deleted_at' => NULL,
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
                'remember_token' => 'ZK5WRLO9hdxm91fcWwOW8433Cky9MSQsXTYAHYy8cifPjUXM5SPKQZYGuOBU',
                'role' => 'moderator',
                'created_at' => '2020-01-20 07:01:28',
                'updated_at' => '2020-04-21 09:33:31',
                'deleted_at' => NULL,
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
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-02-05 23:29:38',
                'updated_at' => '2020-02-05 23:29:38',
                'deleted_at' => NULL,
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
            ),
            12 => 
            array (
                'id' => 13,
                'first_name' => 'Elowenn',
                'last_name' => 'Mitaillé',
                'username' => '_elowxnn',
                'email' => 'wennwendmsp@gmail.com',
                'password' => '$2y$10$/UNQJG/yaoqQCv3V5/dv1.AERmgadEY1fnpunXek4N5pzpntGcIG2',
                'locale' => 'fr_FR',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'role' => 'member',
                'created_at' => '2020-04-08 12:40:24',
                'updated_at' => '2020-04-08 12:40:51',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}