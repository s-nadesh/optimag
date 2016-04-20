<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ads_positions', function (Blueprint $table) {
            $table->increments('pid');
            $table->string('title');
            $table->string('format');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        
        DB::table('ads_positions')->insert([
            'title' => 'Home',
            'format' => '160x600',
            'status' => 1,
        ]);
        
        DB::table('ads_positions')->insert([
            'title' => 'Section',
            'format' => '160x600',
            'status' => 1,
        ]);
        
        DB::table('ads_positions')->insert([
            'title' => 'Articles',
            'format' => '160x600',
            'status' => 1,
        ]);
    
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
