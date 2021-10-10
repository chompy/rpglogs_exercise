<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterParseFetchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_parse_fetch_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('character_name');
            $table->string('server_name');
            $table->string('server_region');
            $table->integer('parse_count');
            $table->string('avatar_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_parse_fetch_histories');
    }
}
