<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>1,
        ]);
        DB::table('comments')->insert([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>2,
        ]);
        DB::table('comments')->insert([
            'body'=>'some comment here from a simple user',
            'user_id'=>1,
            'post_id'=>3,
        ]);
    }
}
