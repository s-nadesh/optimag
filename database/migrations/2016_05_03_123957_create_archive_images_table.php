<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('archive_images', function (Blueprint $table) {
            $table->increments('id_image');
            $table->integer('id_category')->unsigned();
            $table->string('image', 300);
            $table->string('title_image_fr', 300);
            $table->string('title_image_en', 300);
            $table->string('extension', 5);
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign Keys
            $table->foreign('id_category')
                    ->references('id_category')->on('archive_categories')
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
        //
    }
}
