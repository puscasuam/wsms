<?php

use Illuminate\Database\Seeder;

class GemstoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gemstones')->insert(
            [
                'name'=>'Opal'
            ]);

        DB::table('gemstones')->insert(
            [
                'name'=>'Ruby'
            ]);

        DB::table('gemstones')->insert(
            [
                'name'=>'Amethyst'
            ]);

        DB::table('gemstones')->insert(
            [
                'name'=>'Sapphire'
            ]);

        DB::table('gemstones')->insert(
            [
                'name'=>'Diamond'
            ]);
    }
}
