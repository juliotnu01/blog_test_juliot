<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;
class CommetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class)->create();
    }
}
