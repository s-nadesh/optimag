<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdsColumn4Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads', function ($table) {
            if (!Schema::hasColumn('ads', 'id_image'))
            {
                $table->string('id_image')->after('ad_type');
                //Foreign Keys
                $table->foreign('id_image')
                        ->references('id_image')->on('archive_images')
                        ->onDelete('cascade');
            }    
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
