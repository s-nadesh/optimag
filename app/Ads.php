<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model{
    
    protected $primaryKey = 'ad_id';
        
    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'ad_title' => 'required|min:3',          
                ], $merge);
    }
    
    public function adsPosition() {
        return $this->belongsTo('App\AdsPosition', 'page', 'pid');
    }
    
 }
