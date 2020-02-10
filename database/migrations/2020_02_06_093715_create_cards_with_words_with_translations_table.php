<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsWithWordsWithTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cards_with_words_with_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('words_with_translations_id')->unsigned();
            $table
                    ->foreign('words_with_translations_id')
                    ->references('id')
                    ->on('words_with_translations')
                    ->onDelete('cascade');
            $table->integer('card_id')->unsigned();
            $table
                    ->foreign('card_id')
                    ->references('id')
                    ->on('cards')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('cards_with_words_with_translations');
    }

}
