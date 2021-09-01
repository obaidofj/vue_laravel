<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'obaid',
            'email'=>'obaidofj21@gmail.com',
            'password'=>bcrypt('123456'),
            'profile_img'=>'img1.jpg'
        ]);

        DB::table('users')->insert([
            'name'=>'Obaid',
            'email'=>'obaidofj16@gmail.com',
            'password'=>bcrypt('1234567'),
            'profile_img'=>'img1.jpg',
            'is_admin'=>true
        ]);
    }
}
