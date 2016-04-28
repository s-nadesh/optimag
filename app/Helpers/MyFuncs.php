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
        $data   = array(); 
        
        $counts = 1;
        $result = MyFuncs::get_banner_result($positionid,$lang,$counts);

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
            $adsresult = MyFuncs::get_adsense_result($positionid,$counts);
            if (!empty($adsresult)) {  
                $data['content'] = $adsresult[0]->ads_content;
            }
        }

        return $data;
    }    
    
    public static function section_banner_display($positionid,$lang)
    {
        $data    = array(); 
        $counts  = 3;
        $results = MyFuncs::get_banner_result($positionid,$lang,$counts);
        
        if (!empty($results)) 
        {   
            foreach($results as $binfo)
            {  
                $data[] = [
                'ad_id'     => $binfo->ad_id,
                'ad_title'  => $binfo->ad_title,
                'ad_link'   => $binfo->ad_link,
                'ad_file'   => $binfo->ad_file,
                'ad_type'   => $binfo->ad_type,
                'advertiser_url'  => $binfo->advertiser_url,
                'client_name'     => $binfo->client_name,
                'content'         => ""
                ];
                
                $ads_id = $binfo->ad_id;

               // Add one count impressions for the loading banner.
                DB::table('ads')->where('ad_id', $ads_id)->increment('impressions');
            }

        } else {
            
            $adsresult = MyFuncs::get_adsense_result($positionid,$counts);
            if (!empty($adsresult)) 
            {  
                foreach($adsresult as $rinfo)
                {                   
                    $data[] = [
                       'content' => $rinfo->ads_content
                    ];
                }
            }
        }
        
       return $data;
    }  
    
    public static function get_adsense_result($positionid,$counts) {
        
        $ads_result = DB::table('adsenses')                   
                    ->where('page', '=', $positionid)
                    ->where('status', '=', 1) 
                    ->orderBy(DB::raw('RAND()'))
                    ->take($counts)
                    ->get();   
        return $ads_result;
    }

    public static function get_banner_result($positionid,$lang,$counts ) {
       
        $now   = date('Y-m-d', time());
        
        $ad_result = DB::table('ads')
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)
                    ->where('page', '=', $positionid)
                    ->where('lang', '=', $lang)  
                    ->where('status', '=', 1) 
                    ->orderBy(DB::raw('RAND()'))
                    ->take($counts)
                    ->get();   
        
        return $ad_result;
    }

}
