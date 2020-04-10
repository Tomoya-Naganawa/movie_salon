<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('castings', function (Blueprint $table) {
            $table->unsignedInteger('movie_id')->comment('映画ID');
            $table->unsignedInteger('actor_id')->comment('俳優ID');
            $table->timestamps();

            $table->index('movie_id');
            $table->index('actor_id');

            $table->unique([
                'movie_id',
                'actor_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('castings');
    }
}
