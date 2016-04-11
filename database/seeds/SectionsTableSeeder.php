<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            'section_name_en' => 'Sports',
            'section_name_fr' => 'Sports',
            'section_slug_en' => 'sports',
            'section_slug_fr' => 'sports',
            'status' => 1,
        ]);
        DB::table('sections')->insert([
            'section_name_en' => 'Entertainment',
            'section_name_fr' => 'Entertainment',
            'section_slug_en' => 'entertainment',
            'section_slug_fr' => 'entertainment',
            'status' => 1,
        ]);
        
    }
}
