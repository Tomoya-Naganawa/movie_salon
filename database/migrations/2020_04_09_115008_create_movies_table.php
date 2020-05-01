<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tmdb_id')->comment('TMDBの映画ID');
            $table->string('title')->comment('タイトル');
            $table->date('release_date')->nullable()->comment('公開日');
            $table->integer('runtime')->nullable()->comment('上映時間');
            $table->string('poster_path')->nullable()->comment('イメージ画像');
            $table->float('rating_avg', 3, 2)->nullable()->comment('総合評価');
            $table->string('director')->nullable()->comment('監督');
            $table->string('tagline')->nullable()->comment('キャッチフレーズ');
            $table->string('overview', 1600)->comment('あらすじ');
            $table->timestamps();

            $table->index('id');
            $table->index('tmdb_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
