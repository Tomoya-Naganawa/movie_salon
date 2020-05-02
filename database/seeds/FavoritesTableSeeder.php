<?php

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::create([ 
            'user_id' => 2,
            'review_id' => 1,
        ]);

        Favorite::create([ 
            'user_id' => 3,
            'review_id' => 1,
        ]);

        Favorite::create([ 
            'user_id' => 4,
            'review_id' => 1,
        ]);

        Favorite::create([ 
            'user_id' => 5,
            'review_id' => 1,
        ]);

        Favorite::create([ 
            'user_id' => 6,
            'review_id' => 2,
        ]);

        Favorite::create([ 
            'user_id' => 7,
            'review_id' => 2,
        ]);

        Favorite::create([ 
            'user_id' => 8,
            'review_id' => 2,
        ]);

        Favorite::create([ 
            'user_id' => 9,
            'review_id' => 3,
        ]);

        Favorite::create([ 
            'user_id' => 10,
            'review_id' => 4,
        ]);
    }
}
