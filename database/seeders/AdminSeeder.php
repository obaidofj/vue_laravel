<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

          \App\User::create([
            'name'=>'Obaid',
            'email'=>'obaidofj16@gmail.com',
            'password'=>bcrypt('1234567'),
            'profile_img'=>'img1.jpg',
            'is_admin'=>true
        ]);
    }
}
