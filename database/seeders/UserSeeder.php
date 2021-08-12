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
            'email'=>'obaidofj@gmail.com',
            'password'=>bcrypt('123456'),
            'profile_img'=>'img1.jpg'
        ]);
    }
}
