<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('editions', function (Blueprint $table) {
            $table->increments('edition_id');
            $table->string('edition_name_en');
            $table->string('edition_name_fr');
            $table->string('edition_slug_en', 300);
            $table->string('edition_slug_fr', 300);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('editions');
    }

}
