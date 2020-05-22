<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert(
            [
                'name'=>'Luv Aj'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Jennifer Zeuner'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Ettika'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Missoma'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Kendra Scott'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Shashi'
            ]);

        DB::table('brands')->insert(
            [
                'name'=>'Bumble Bar'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'Gorjana'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'8 Other Reasons'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'Cult Gaia'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'Maison Miru'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'Tiffany & Co.'
            ]);
        DB::table('brands')->insert(
            [
                'name'=>'The last line'
            ]);
    }
}
