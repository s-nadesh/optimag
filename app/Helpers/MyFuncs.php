<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class MyFuncs {

    public static function languages() {
        return ['en' => 'English', 'fr' => 'French'];
    }

    public static function getYears() {
        $earliest_year = 2000;
        $latest_year = date('Y');
        $year = array();
        foreach (range($latest_year, $earliest_year) as $i) {
            $year[$i] = $i;
        }
        return $year;
    }

    public static function getRandomString($length = 9) {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //length:36
        $final_rand = '';
        for ($i = 0; $i < $length; $i++) {
            $final_rand .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $final_rand;
    }

    public static function getArticleUniqueKey($length = 6) {
        $new_guid = strtoupper(self::getRandomString($length));
        do {
            $exist_count = DB::table('articles')->where('article_key', $new_guid)->count();
            if ($exist_count > 0) {
                $old_guid = $new_guid;
                $new_guid = self::getRandomString($length);
            } else {
                break;
            }
        } while ($old_guid != $new_guid);
        return $new_guid;
    }

}
