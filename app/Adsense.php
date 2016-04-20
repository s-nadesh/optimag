<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Adsense extends Model {

    use SluggableTrait;

    protected $primaryKey = 'ads_id';
    protected $fillable = [
        'ads_content',
        'position',
        'status',
    ];
    

    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'ads_content' => 'required|min:3|unique:adsenses,ads_content,' . ($id ? "$id" : 'NULL') . ',ads_id',
                ], $merge);
    }
    
    public function adsPosition() {
        return $this->belongsTo('App\AdsPosition', 'position', 'pid');
    }

}
