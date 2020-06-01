<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\User;
use App\Models\Movie;
use App\Libraries\TmdbService;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 正常系：新規の映画の保存
     * 
     * @dataProvider RequestData
     * @param $movie
     * @param $credit
     */
    public function testStoreMovie($movie, $credit)
    {
        $tmdbServiceMock = Mockery::mock('overload:\App\Libraries\TmdbService');
        $tmdbServiceMock->shouldReceive('getMovieArray')
                         ->once()
                         ->andReturn($movie);
                   
        $tmdbServiceMock->shouldReceive('getCreditArray')
                          ->once()
                          ->andReturn($credit);

        $this->instance('App\Libraries\TmdbService', $tmdbServiceMock);

        $user = factory(User::class)->create();
        $url = url('/movies/157336/store');
        $response = $this->actingAs($user)->get($url);

        $this->assertDatabaseHas('movies', [
            'tmdb_id'      => $movie['id'],
            'title'        => $movie['title'],
            'release_date' => $movie['release_date'],
            'runtime'      => $movie['runtime'],
            'poster_path'  => $movie['poster_path'],
            'tagline'      => $movie['tagline'],
            'overview'     => $movie['overview']
        ]);

        for($i = 1; $i <= 4; $i++){
            $this->assertDatabaseHas('actor_movie',[
                'actor_id' => $i,
                'movie_id' => 1,
            ]);
        }
        
        foreach($credit['cast'] as $cast){
            $this->assertDatabaseHas('actors', $cast);
        }

        foreach($movie['genres'] as $genre){
            $this->assertDatabaseHas('genres', [
                'movie_id' => 1,
                'genre_id' => $genre
            ]);
        }
    }

    /**
     * 正常系：既に同じ映画が保存されている場合、映画詳細画面へリダイレクト
     */
    public function testRedirectExistingMovie()
    {
        $user = factory(User::class)->create();
        $movie = factory(Movie::class)->create();

        $url = url('/movies/157336/store');
        $response = $this->actingAs($user)->get($url);

        $response->assertRedirect(url('/movies/1'));
    }

    public function RequestData()
    {
        return [
            'dummyResponse' => [
                'movieData' => [
                    'id'           => 157336,
                    'title'        => 'インターステラー',
                    'release_date' => '2014-11-05',
                    'runtime'      => 169,
                    'poster_path'  => '/v6oNcydMvHwV8sxNIF8eivbw8tK.jpg',
                    'tagline'      => '必ず、帰ってくる。 それは宇宙を超えた父娘の約束━━。',
                    'overview'     => '近未来の地球では植物の枯死、異常気象により人類は滅亡の危機に立たされていた...',
                    'genres' => [
                        0 => ['id' => 12], 
                        1 => ['id' => 18], 
                        2 => ['id' => 878]
                    ]
                ],
                'creditData' => [
                    'cast' => [
                        0 => [
                            'name'         => 'Matthew McConaughey',
                            'profile_path' => '/sY2mwpafcwqyYS1sOySu1MENDse.jpg'
                        ], 
                        1 => [
                            'name'         => 'Jessica Chastain',
                            'profile_path' => '/4Qyty9CLJchru1QdOTEHspL3SEk.jpg'
                        ], 
                        2 => [
                            'name'         => 'Anne Hathaway',
                            'profile_path' => '/tLelKoPNiyJCSEtQTz1FGv4TLGc.jpg'
                        ], 
                        3 => [
                            'name'         => 'Michael Caine',
                            'profile_path' => '/5K0WR3yaodF8Cz4nTo0sNinFDdw.jpg'
                        ]
                    ]
                ]
            ]
        ];   
    }    
}
