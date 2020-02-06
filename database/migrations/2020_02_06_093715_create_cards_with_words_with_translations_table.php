<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsWithWordsWithTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_with_words_with_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('words_with_translations_id')->unsigned();
            $table
                ->foreign('words_with_translations_id')
                ->references('words_with_translation')
                ->on('id');
            $table
                ->integer('card_id')
                ->foreign('card')
                ->on('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards_with_words_with_translations');
    }
}
