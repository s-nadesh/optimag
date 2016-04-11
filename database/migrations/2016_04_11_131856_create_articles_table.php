<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('article_id');
            $table->string('language', 2);
            $table->integer('edition_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->string('year', 10);
            $table->string('title', 255);
            $table->text('description');
            $table->text('embed_video');
            $table->string('writer_name', 100);
            $table->string('writer_company', 255);
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign Keys
            $table->foreign('edition_id')
                    ->references('edition_id')->on('editions')
                    ->onDelete('cascade');
            
            $table->foreign('section_id')
                    ->references('section_id')->on('sections')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('articles');
    }

}
