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
            CommetSeeder::class,
            LocationSeeder::class,
            PhotoSeeder::class,
            TagPhotosSeeder::class,
            TagSeeder::class,
            ALbumSeeder::class,
            MemberSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
