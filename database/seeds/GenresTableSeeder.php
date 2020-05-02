<?php

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'movie_id' => 1,
            'genre_id' => 12,
        ]);

        Genre::create([
            'movie_id' => 1,
            'genre_id' => 18,
        ]);

        Genre::create([
            'movie_id' => 1,
            'genre_id' => 878,
        ]);

        Genre::create([
            'movie_id' => 2,
            'genre_id' => 28,
        ]);

        Genre::create([
            'movie_id' => 2,
            'genre_id' => 878,
        ]);

        Genre::create([
            'movie_id' => 3,
            'genre_id' => 35,
        ]);

        Genre::create([
            'movie_id' => 3,
            'genre_id' => 18,
        ]);

        Genre::create([
            'movie_id' => 4,
            'genre_id' => 18,
        ]);

        Genre::create([
            'movie_id' => 4,
            'genre_id' => 80,
        ]);
    }
}
