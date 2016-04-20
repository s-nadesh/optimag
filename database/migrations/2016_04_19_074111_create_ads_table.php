<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create('ads', function (Blueprint $table) {
            $table->increments('ad_id');
            $table->string('ad_title');
            $table->string('ad_link');
            $table->string('ad_image');
            $table->string('client_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('impressions');
            $table->integer('clicks');
            $table->integer('position');
            $table->string('lang');
            $table->integer('status')->default(1);
            $table->timestamps();
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
