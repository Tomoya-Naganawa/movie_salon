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
            $table->string('title')->comment('タイトル');
            $table->date('release_date')->nullable()->comment('公開日');
            $table->integer('runtime')->nullable()->comment('上映時間');
            $table->string('movie_image')->nullable()->comment('イメージ画像');
            $table->float('rating_avg', 3, 2)->nullable()->comment('総合評価');
            $table->string('director')->nullable()->comment('監督');
            $table->string('tagline')->nullable()->comment('キャッチフレーズ');
            $table->string('text', '1050')->nullable()->comment('本文');
            $table->timestamps();

            $table->index('id');
            $table->index('title');
            $table->index('director');
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
