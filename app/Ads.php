<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model{
    
    protected $primaryKey = 'ad_id';
        
    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'ad_title' => 'required|min:3',  
            'page' => 'required',
            
            'ad_type' => 'required_if:page,1',
            
            'video_embed' => 'required_if:ad_type,video',
            'advertiser_url' => 'required_if:ad_type,video|active_url',
            
            'image_category' => 'required_if:ad_type,image|required_if:page,2,3',
            'image' => 'required_if:ad_type,image|required_if:page,2,3',
                        
//            'image' => 'required_if:ad_type,image|Mimes:jpeg,png,gif|required_if:page,2,3',
            'ad_link' => 'required_if:ad_type,image|active_url|required_if:page,2,3',
            
                ], $merge);
       
        
    }
    
    public function adsPosition() {
        return $this->belongsTo('App\AdsPosition', 'page', 'pid');
    }
    
    public function archiveimage() {
        return $this->belongsTo('App\ArchiveImage', 'id_image', 'id_image');
    }
    
 }
