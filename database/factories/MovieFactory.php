<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Movie;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'tmdb_id'      => 157336,
        'title'        => 'インターステラー',
        'release_date' => '2014-11-05',
        'runtime'      => 169,
        'poster_path'  => '/v6oNcydMvHwV8sxNIF8eivbw8tK.jpg',
        'tagline'      => '必ず、帰ってくる。 それは宇宙を超えた父娘の約束━━。',
        'overview'     => '近未来の地球では植物の枯死、異常気象により人類は滅亡の危機に立たされていた...',
        'created_at'     => now(),
        'updated_at'     => now()
    ];
});