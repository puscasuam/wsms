<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//       $this->call(MaterialsTableSeeder::class);
//        $this->call(BrandTableSeeder::class);
//        $this->call(CategoriesTableSeeder::class);
        $this->call(GemstoneTableSeeder::class);
        $this->call(LocationTableSeeder::class);
       $this->call(SublocationTableSeeder::class);
//        $this->call(UserSeeder::class);
    }
}
