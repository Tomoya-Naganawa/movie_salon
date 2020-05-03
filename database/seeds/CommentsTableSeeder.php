<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
                'user_id' => 2,
                'review_id' => 1,
                'text' => 'なるほどね。',
        ]);

        Comment::create([
                'user_id' => 3,
                'review_id' => 1,
                'text' => '僕もそう思います。',
        ]);

        Comment::create([
                'user_id' => 4,
                'review_id' => 1,
                'text' => '確かにそういう見方もできますね。',
        ]);

        Comment::create([
                'user_id' => 5,
                'review_id' => 1,
                'text' => 'なるほどね。',
        ]);

        Comment::create([
                'user_id' => 6,
                'review_id' => 2,
                'text' => '僕もそう思います。',
        ]);

        Comment::create([
                'user_id' => 7,
                'review_id' => 2,
                'text' => '確かにそういう見方もできますね。',
        ]);

        Comment::create([
                'user_id' => 8,
                'review_id' => 2,
                'text' => 'なるほどね。',
        ]);

        Comment::create([
                'user_id' => 9,
                'review_id' => 3,
                'text' => '僕もそう思います。',
        ]);

        Comment::create([
                'user_id' => 10,
                'review_id' => 4,
                'text' => '確かにそういう見方もできますね。',
        ]);
    }
}
