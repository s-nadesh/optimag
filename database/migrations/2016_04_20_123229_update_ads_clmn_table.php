<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdsClmnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::table('ads', function ($table) {
            $table->string('advertiser_url')->after('ad_type');
        });
        
        Schema::table('ads', function ($table) {
            $table->text('ad_file')->change();
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
         Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('advertiser_url');
        });
    }
}
