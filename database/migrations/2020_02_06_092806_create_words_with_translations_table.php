<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsWithTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words_with_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('word_id')->unsigned();
            $table->integer('scores')->unsigned()->default(0);
            $table
                ->foreign('word_id')
                ->references('id')
                ->on('words')
                ->onDelete('cascade');
            $table->integer('translation_id')->unsigned();
            $table
                ->foreign('translation_id')
                ->references('id')
                ->on('translations')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words_with_translations');
    }
}
