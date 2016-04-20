<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $primaryKey = 'ad_id';
    protected $fillable = [];


    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'ad_title' => 'required|min:3',          
                ], $merge);
    }
    
//    public static function getAdspositions(){
//        $section = Ads::lists('section_name_en', 'section_id');
//        return $section;
//    }
    
//    public function articles() {
//        return $this->hasMany('App\Article', 'section_id', 'section_id');
//    }

}
