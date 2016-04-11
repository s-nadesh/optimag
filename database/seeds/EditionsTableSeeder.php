<?php

use Illuminate\Database\Seeder;

class EditionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('editions')->insert([
            'edition_name_en' => 'Jan Feb',
            'edition_name_fr' => 'Jan Feb',
            'edition_slug_en' => 'jan-feb',
            'edition_slug_fr' => 'jan-feb',
            'status' => 1,
        ]);
        DB::table('editions')->insert([
            'edition_name_en' => 'Mar Apr',
            'edition_name_fr' => 'Mar Apr',
            'edition_slug_en' => 'mar-apr',
            'edition_slug_fr' => 'mar-apr',
            'status' => 1,
        ]);
        DB::table('editions')->insert([
            'edition_name_en' => 'May Jun',
            'edition_name_fr' => 'May Jun',
            'edition_slug_en' => 'may-jun',
            'edition_slug_fr' => 'may-jun',
            'status' => 1,
        ]);
        DB::table('editions')->insert([
            'edition_name_en' => 'Jul Aug',
            'edition_name_fr' => 'Jul Aug',
            'edition_slug_en' => 'jul-aug',
            'edition_slug_fr' => 'jul-aug',
            'status' => 1,
        ]);
        DB::table('editions')->insert([
            'edition_name_en' => 'Sep Oct',
            'edition_name_fr' => 'Sep Oct',
            'edition_slug_en' => 'sep-oct',
            'edition_slug_fr' => 'sep-oct',
            'status' => 1,
        ]);
        DB::table('editions')->insert([
            'edition_name_en' => 'Nov Dec',
            'edition_name_fr' => 'Nov Dec',
            'edition_slug_en' => 'nov-dec',
            'edition_slug_fr' => 'nov-dec',
            'status' => 1,
        ]);
    }

}
