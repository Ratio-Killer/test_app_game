<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $genres = [
            'Action',
            'Adventure',
            'RPG',
            'Shooter',
            'Strategy',
            'Sports',
            'Racing',
            'Simulation',
            'Horror',
            'Fighting',
        ];

        $platforms = [
            'PlayStation 4',
            'PlayStation 5',
            'Xbox One',
            'Xbox Series X',
            'Nintendo Switch',
            'PC',
            'Mac',
            'Linux',
            'Android',
            'iOS',
        ];

        $games = [];

        for ($i = 0; $i < 20; $i++) {
            $games[] = [
                'title' => $faker->word,
                'developer' => $faker->company,
                'genre' => $faker->randomElement($genres),
                'release_date' => $faker->date,
                'platform' => $faker->randomElement($platforms),
                'price' => $faker->randomFloat(2, 10, 100),
                'cover' => json_encode(
                    ['path' => 'covers/' . $faker->image('public/storage/covers',
                            400,
                            300,
                            null,
                            false
                        )]),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('games')->insert($games);
    }
}
