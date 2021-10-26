<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::statement('SET FOREIGN_KEY_CHECKS=0');
 
         //membuat beberapa user secara manual
         \DB::table('users')->insert([
             [
                 'name'=>"Monika Panjaitan",
                 'email'=>"monikapanjaitan@gmail.com",
                 'password'=>bcrypt('rahasia1'),
                 'role'=>'admin',
             ],
             [
                'name'=>"Andreas",
                'email'=>"andreas@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'user',
             ],
             [
                'name'=>"Christian",
                'email'=>"christian@gmail.com",
                'password'=>bcrypt('rahasia1'),
                'role'=>'user',
             ],
         ]);
 
    }
}
