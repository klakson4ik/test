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
        $this->call(MobilesTableSeeder::class);
        $this->call(LargeTechnicalsTableSeeder::class);
        $this->call(ComputersTableSeeder::class);
        $this->call(TelevisionsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ChunksCategoryTableSeeder::class);
    }

}
