<?php

use Illuminate\Database\Seeder;

class SublocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A1',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A2',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A3',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A4',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A5',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A6',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A7',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A8',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A9',
                'capacity'=>10
            ]);

        DB::table('sublocations')->insert(
            [
                'location_id'=>2,
                'name'=>'A10',
                'capacity'=>10
            ]);
    }
}
