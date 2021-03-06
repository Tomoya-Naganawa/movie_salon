<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\User;
use App\Models\Movie;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 正常系
     * @dataProvider ValidData
     * @param $movie
     * @param $param
     */
    public function testSearchMovie($movie, $param)
    {
        $tmdbServiceMock = Mockery::mock('overload:\App\Libraries\TmdbService');
        $tmdbServiceMock->shouldReceive('getSearchArray')
                        ->once()
                        ->andReturn($movie);

        $user = factory(User::class)->create();
        $url = url('/search?query='.$param['query'].'&category='.$param['category']);
        $response = $this->actingAs($user)->get($url);

        $response->assertStatus(200);
        $response->assertViewIs('tmdbs.search');
    }

     /**
     * 異常系
     * @dataProvider InvalidData
     * @param $param
     */
    public function testSearchMovieValidationError($param)
    {
        $user = factory(User::class)->create();
        $url = url('/search?query='.$param['requestData']['query'].'&category='.$param['requestData']['category']);
        $response = $this->actingAs($user)->get($url);

        $response->assertStatus(302);
    }

    /**
     *    DataProvider
     */
    public function ValidData()
    {
        return [
            'Request has all movie data' => [
                'movieData' => [
                    'page' => 1,
                    'total_pages' => 1,
                    'results' => [
                        [
                            'id'           => 157336,
                            'title'        => 'インターステラー',
                            'release_date' => '2014-11-05',
                            'poster_path'  => '/v6oNcydMvHwV8sxNIF8eivbw8tK.jpg',
                            'overview'     => '近未来の地球では植物の枯死、異常気象により人類は滅亡の危機に立たされていた...',
                        ]
                    ]
                ],
                'queryParam' => [
                    'query' => 'インターステラー',
                    'category' => 'movie'    
                ]
            ], 

            'Request has all person data' => [
                'movieData' => [
                    'page' => 1,
                    'total_pages' => 1,
                    'results' => [
                        [
                            'id'        => 206,
                            'name'      => 'ジム・キャリー',
                            'known_for_department' => 'Acting',
                            'known_for' => [
                                [
                                    'id' => 37165,
                                    'title' => 'トゥルーマン・ショー',
                                ],
                                [
                                    'id' => 38,
                                    'title' => 'エターナル・サンシャイン',
                                ],
                                [
                                    'id' => 310,
                                    'title' => 'ブルース・オールマイティ',
                                ]
                            ]
                        ]
                    ]
                ],
                'queryParam' => [
                    'query' => 'ジム・キャリー',
                    'category' => 'person'    
                ]
            ],

            'Request has "" ' => [
                'movieData' => [
                    'page' => 1,
                    'total_pages' => 1,
                    'results' => [
                        [
                            'id'           => 157336,
                            'title'        => 'インターステラー',
                            'release_date' => '',
                            'poster_path'  => '',
                            'overview'     => '',
                        ]
                    ]
                ],
                'queryParam' => [
                    'query' => 'インターステラー',
                    'category' => 'movie'    
                ]
            ],

            'known_for is []' => [
                'movieData' => [
                    'page' => 1,
                    'total_pages' => 1,
                    'results' => [
                        [
                            'id'        => 206,
                            'name'      => 'ジム・キャリー',
                            'known_for_department' => 'Acting',
                            'known_for' => []
                        ]
                    ]
                ],
                'queryParam' => [
                    'query' => 'ジム・キャリー',
                    'category' => 'person'    
                ]
            ],
        ];    
    }

    public function InvalidData()
    {
        return [
            'validation: query is null' => [
                [
                    'requestData' => [
                        'query' => null,
                        'category' => 'movie'    
                    ]
                ]
            ],
            'validation: category is null' => [
                [
                    'requestData' => [
                        'query' => 'インターステラー',
                        'category' => null   
                    ]
                ]
            ],
            'validation: query is not movie or person' => [
                [
                    'requestData' => [
                        'query' => 'インターステラー',
                        'category' => 'abcde'   
                    ]
                ]
            ]
        ];
    }
}