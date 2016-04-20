<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class AdsPosition extends Model {

    use SluggableTrait;

    protected $primaryKey = 'pid';
    protected $fillable = [
        'title',
        'format',
        'status',
    ];
    

    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'title' => 'required|min:3|unique:adspositions,title,' . ($id ? "$id" : 'NULL') . ',pid',
            'format' => 'required|unique:adspositions,format,' . ($id ? "$id" : 'NULL') . ',pid',            
                ], $merge);
    }
    
   public static function getAdsPositions(){
        $position = AdsPosition::lists('title', 'pid');
        return $position;
    }
    
    public function adsense() {
        return $this->hasMany('App\Adsense', 'pid', 'position');
    }

}
