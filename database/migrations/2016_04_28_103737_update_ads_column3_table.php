<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdsColumn3Table extends Migration
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
            $table->renameColumn('position', 'page');           
        });
        
        Schema::table('ads', function ($table) {
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
         Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('page');
            $table->dropColumn('position');
        });
    }
}
