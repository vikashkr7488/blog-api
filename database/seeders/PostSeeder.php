<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/*$faker = Faker::create();
        DB::table('posts')->insert([
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
        ]);*/
		
		\App\Models\Post::factory()->times(15)->create();
    }
}
