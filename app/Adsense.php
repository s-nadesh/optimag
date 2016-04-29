<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adsense extends Model {

    protected $primaryKey = 'ads_id';
    protected $fillable = array('ads_content', 'page', 'position', 'status');
    
    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'ads_content' => 'required|min:3',
                ], $merge);
    }
    
    public function adsPosition() {
        return $this->belongsTo('App\AdsPosition', 'page', 'pid');
    }

}
