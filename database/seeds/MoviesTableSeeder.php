<?php

use Illuminate\Database\Seeder;
use App\Models\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            'tmdb_id' => 157336,
            'title' => 'インターステラー',
            'release_date' => '2014-11-05',
            'runtime' => 169,
            'poster_path' => '/v6oNcydMvHwV8sxNIF8eivbw8tK.jpg',
            'rating_avg' => 4.5,
            'tagline' => '必ず、帰ってくる。 それは宇宙を超えた父娘の約束━━。',
            'overview' => '近未来の地球では植物の枯死、異常気象により人類は滅亡の危機に立たされていた。元宇宙飛行士クーパーは、義父と15歳の息子トム、10歳の娘マーフとともにトウモロコシ農場を営んでいる。マーフは自分の部屋の本棚から本がひとりでに落ちる現象を幽霊のせいだと信じていたが、ある日クーパーはそれが何者かによるメッセージではないかと気が付く。クーパーとマーフはメッセージを解読し、それが指し示している秘密施設にたどり着くが、最高機密に触れたとして身柄を拘束される。',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Movie::create([
            'tmdb_id' => 603,
            'title' => 'マトリックス',
            'release_date' => '1999-03-30',
            'runtime' => 136,
            'poster_path' => '/uOGuu8P0dfBIX8JDWKzMU3cHo12.jpg',
            'rating_avg' => 4,
            'tagline' => 'なぜ 気づかない',
            'overview' => 'トーマス・アンダーソンは、大手ソフトウェア会社に勤めるプログラマである。しかし彼には天才ハッカー、ネオというもう一つの顔があった。ある日、彼はとある人物から連絡を受け、警察に追われる。そして彼から衝撃的な世界の真実を告げられた。',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Movie::create([
            'tmdb_id' => 37165,
            'title' => 'トゥルーマン・ショー',
            'release_date' => '1998-06-04',
            'runtime' => 103,
            'poster_path' => '/vuza0WqY239yBXOadKlGwJsZJFE.jpg',
            'rating_avg' => 4.5,
            'tagline' => 'ご覧の番組は、彼だけ知りません。',
            'overview' => '典型的なアメリカ市民・トゥルーマン。だが彼の暮らす環境は、どことなく不自然だ。それもそのはず、実は彼の人生は、隠しカメラによってTV番組「トゥルーマン・ショー」として世界中に放送されていたのだ!家族や友人を含めたこれまでの人生が全てフィクションだったと知った彼は、現実の世界への脱出を決意する…。メディアによって作られた人生の悲喜劇に、見事なリアリティを与えているジム・キャリーの熱演が光る傑作コメディ。',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Movie::create([
            'tmdb_id' => 278,
            'title' => 'ショーシャンクの空に',
            'release_date' => '1994-09-23',
            'runtime' => 143,
            'poster_path' => '/5NyJbE7JVfDJtP7c4CQzxgCLHFY.jpg',
            'rating_avg' => 4.5,
            'tagline' => '',
            'overview' => '妻とその愛人を射殺したかどでショーシャンク刑務所送りとなった銀行家アンディ。初めは戸惑っていたが、やがて彼は自ら持つ不思議な魅力ですさんだ受刑者達の心を掴んでゆく。そして20年の歳月が流れた時、彼は冤罪を晴らす重要な証拠をつかむ。',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
