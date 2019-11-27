<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$10$d92BL4f2sVPV4o/Jyc9AHu/2rK5BLrbz1/TnoA.SfN3MQImYKSN16',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'yKhL82KriVWShkTkDm5MNDRHQL66H4sAuUDBiGXirjRYjyN03UziMRiTJMV4',
                'created_at' => '2019-11-27 08:25:20',
                'updated_at' => '2019-11-27 08:25:20',
            ),
        ));
        
        
    }
}