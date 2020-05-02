<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([

            [
                'user_id' => 2,
                'review_id' => 1,
                'text' => 'なるほどね。',
            ],

            [
                'user_id' => 3,
                'review_id' => 1,
                'text' => '僕もそう思います。',
            ],

            [
                'user_id' => 4,
                'review_id' => 1,
                'text' => '確かにそういう見方もできますね。',
            ],

            [
                'user_id' => 5,
                'review_id' => 1,
                'text' => 'なるほどね。',
            ],

            [
                'user_id' => 6,
                'review_id' => 2,
                'text' => '僕もそう思います。',
            ],

            [
                'user_id' => 7,
                'review_id' => 2,
                'text' => '確かにそういう見方もできますね。',
            ],

            [
                'user_id' => 8,
                'review_id' => 2,
                'text' => 'なるほどね。',
            ],

            [
                'user_id' => 9,
                'review_id' => 3,
                'text' => '僕もそう思います。',
            ],

            [
                'user_id' => 10,
                'review_id' => 4,
                'text' => '確かにそういう見方もできますね。',
            ],

        ]);
    }
}
