<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
          'name'=>'html tutorials',
          'slug'=>'html-tutorials',
        ]);
        DB::table('categories')->insert([
          'name'=>'css tutorials',
          'slug'=>'css-tutorials',
        ]);
        DB::table('categories')->insert([
          'name'=>'javascript tutorials',
          'slug'=>'javascript-tutorials',
        ]);
        DB::table('categories')->insert([
          'name'=>'laravel tutorials',
          'slug'=>'laravel-tutorials',
        ]);
        DB::table('categories')->insert([
          'name'=>'vue js tutorials',
          'slug'=>'vue-js-tutorials',
        ]);
    }
}
