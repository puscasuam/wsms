<?php

use App\Location;
use App\Sublocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SublocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = Location::all();
        $subs = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

        foreach ($locations as $location){
            foreach ($subs as $sub){
                DB::table('sublocations')->insert(
                    [
                        'location_id'=>$location->id,
                        'name'=>$location->name . $sub,
                        'capacity'=>10
                ]);
            }
        }
    }
}
