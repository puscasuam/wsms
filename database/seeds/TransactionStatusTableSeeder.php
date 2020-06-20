<?php


use Illuminate\Support\Facades\DB;

class TransactionStatusTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('statuses')->insert(
            [
                'status' => 'pending'
            ]);

        DB::table('statuses')->insert(
            [
                'status' => 'paid'
            ]);

        DB::table('statuses')->insert(
            [
                'status' => 'canceled'
            ]);
    }
}
