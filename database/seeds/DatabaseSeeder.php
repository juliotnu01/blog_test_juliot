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
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            MemberSeeder::class,
            LocationSeeder::class,
            ALbumSeeder::class,
            PhotoSeeder::class,
            CommetSeeder::class,
            TagPhotosSeeder::class,
            TagSeeder::class,
            
        ]);
    }
}
