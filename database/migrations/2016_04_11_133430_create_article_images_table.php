<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleImagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('article_images', function (Blueprint $table) {
            $table->increments('article_image_id');
            $table->integer('article_id')->unsigned();
            $table->text('image');
            $table->string('text', 300);
            $table->string('link', 300);
            $table->text('description');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('article_id')
                    ->references('article_id')->on('articles')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('article_images');
    }

}
