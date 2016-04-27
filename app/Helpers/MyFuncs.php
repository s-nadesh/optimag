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
    
     public static function banner_display($positionid,$lang) {
        $data = array(); 
        
        $result = MyFuncs::get_banner_result($positionid,$lang);

        $html = '';
        if (!empty($result)) 
        {            
            $data['ad_id']    = $result[0]->ad_id;
            $data['ad_title'] = $result[0]->ad_title;
            $data['ad_link']  = $result[0]->ad_link;
            $data['ad_file']  = $result[0]->ad_file;
            $data['ad_type']  = $result[0]->ad_type;
            $data['advertiser_url'] = $result[0]->advertiser_url;
            $data['client_name']    = $result[0]->client_name;
            $data['content']        = "";
           
            $ads_id = $result[0]->ad_id;
            
            // Add one count impressions for the loading banner.
            DB::table('ads')->where('ad_id', $ads_id)->increment('impressions');

        } else {
            $adsresult = MyFuncs::get_adsense_result($positionid);
            if (!empty($adsresult)) {  
                $data['content'] = $adsresult[0]->content;
            }
        }

        return $data;
    }

    public static function get_adsense_result($positionid) {
        
        $ads_result = DB::table('adsenses')                   
                    ->where('position', '=', $positionid)                   
                    ->orderBy(DB::raw('RAND()'))
                    ->take(1)
                    ->get();   
        return $ads_result;
    }

    public static function get_banner_result($positionid,$lang ) {
       
        $now   = date('Y-m-d', time());
        
        $ad_result = DB::table('ads')
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)
                    ->where('position', '=', $positionid)
                    ->where('lang', '=', $lang)   
                    ->orderBy(DB::raw('RAND()'))
                    ->take(1)
                    ->get();   
        
        return $ad_result;
    }

}
