<?php

use Illuminate\Database\Seeder;

use App\Models\Album;

class ALbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class)->create();
    }
}
