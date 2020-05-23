<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert(
            [
                'name'=>'A',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'B',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'C',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'D',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'E',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'F',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'G',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'H',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'I',
                'capacity'=>10
            ]);

        DB::table('locations')->insert(
            [
                'name'=>'J',
                'capacity'=>10
            ]);
    }
}
