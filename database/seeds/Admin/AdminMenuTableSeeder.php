<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admin_menu')->delete();

        \DB::table('admin_menu')->insert(array (
            0 =>
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Histoires',
                'icon' => 'fa-book',
                'uri' => '/stories',
                'permission' => NULL,
                'created_at' => '2019-11-27 08:57:10',
                'updated_at' => '2019-11-27 09:04:19',
            ),
            8 =>
            array (
                'id' => 9,
                'parent_id' => 8,
                'order' => 1,
                'title' => 'Nouvelle histoire',
                'icon' => 'fa-plus',
                'uri' => '/stories/create',
                'permission' => NULL,
                'created_at' => '2019-11-27 09:02:50',
                'updated_at' => '2019-11-27 09:03:07',
            ),
            9 =>
            array (
                'id' => 10,
                'parent_id' => 8,
                'order' => 0,
                'title' => 'Liste',
                'icon' => 'fa-book',
                'uri' => '/stories',
                'permission' => NULL,
                'created_at' => '2019-11-27 09:05:39',
                'updated_at' => '2019-11-27 09:07:00',
            ),
            10 =>
            array (
                'id' => 11,
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Jouer !',
                'icon' => 'fa-bars',
                'uri' => 'http://local.hero.com',
                'permission' => NULL,
                'created_at' => '2019-11-27 10:44:48',
                'updated_at' => '2019-11-27 10:44:48',
            ),
        ));


    }
}
