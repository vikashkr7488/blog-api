<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/*$faker = Faker::create();
		
		foreach (range(1, 5) as $value) {
			DB::table('users')->insert([
			'name' => $faker->name,
			'email' => $faker->safeEmail,
			'password' => Hash::make('vikash'),
			]);
		}*/
		
		/* DB::table('users')->insert([
			'name' => Str::random(8),
			'email' => Str::random(10).'@gmail.com',
			'password' => Hash::make('vikash'),
		]); */
		
		\App\Models\User::factory()->times(15)->create();
    }
}
