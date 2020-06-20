<?php


class OrderTypesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('order_types')->insert(
            [
                'type' => 'in'
            ]);

        DB::table('order_types')->insert(
            [
                'type' => 'out'
            ]);
    }
}
