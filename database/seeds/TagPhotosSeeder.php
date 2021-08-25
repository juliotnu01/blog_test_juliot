<?php

use Illuminate\Database\Seeder;
use App\Models\TagPhotos;
class TagPhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TagPhotos::class)->create();
    }
}
