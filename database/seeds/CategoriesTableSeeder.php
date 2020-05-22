<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                'name'=>'Bracelets'
            ]);

        DB::table('categories')->insert(
            [
                'name'=>'Charms'
            ]);

        DB::table('categories')->insert(
            [
                'name'=>'Earrings'
            ]);

        DB::table('categories')->insert(
            [
                'name'=>'Necklaces'
            ]);

        DB::table('categories')->insert(
            [
                'name'=>'Rings'
            ]);

        DB::table('categories')->insert(
            [
                'name'=>'Anklets'
            ]);
    }
}
