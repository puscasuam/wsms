<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materials')->insert(
            [
                'name'=>'925 Silver'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'14K Gold Plated Silver'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'18K Gold Plated Silver'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'24K Gold Plated Silver'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'White Gold'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'Yellow Gold'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'Rose Gold'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'Gold Plated Steel'
            ]);

        DB::table('materials')->insert(
            [
                'name'=>'Stainless Steel'
            ]);
    }
}
