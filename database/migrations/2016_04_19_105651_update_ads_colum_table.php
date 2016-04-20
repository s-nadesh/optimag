<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdsColumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename column
        Schema::table('ads', function ($table) {
            $table->renameColumn('ad_image', 'ad_file');           
        });
        
         Schema::table('ads', function ($table) {
            $table->string('ad_type')->after('ad_file');
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
            $table->dropColumn('ad_file');
            $table->dropColumn('ad_type');
        });
    }
}
