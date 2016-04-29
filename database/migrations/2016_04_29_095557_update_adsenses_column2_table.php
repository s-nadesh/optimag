<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdsensesColumn2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Rename column
        Schema::table('adsenses', function ($table) {
            $table->renameColumn('position', 'page');           
        });
        
        Schema::table('adsenses', function ($table) {
            $table->string('position')->after('page');
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
         Schema::table('adsenses', function (Blueprint $table) {
            $table->dropColumn('page');
            $table->dropColumn('position');
        });
    }
}
