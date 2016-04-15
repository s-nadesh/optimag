<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $primaryKey = 'edition_id';
    protected $fillable = [
        'edition_name_en',
        'edition_name_fr',
    ];
    protected $sluggable = [
        'build_from' => 'edition_name_en',
        'save_to' => 'edition_slug_en',
    ];

    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'edition_name_en' => 'required|min:3|unique:editions,edition_name_en,' . ($id ? "$id" : 'NULL') . ',edition_id',
            'edition_name_fr' => 'required|min:3|unique:editions,edition_name_fr,' . ($id ? "$id" : 'NULL') . ',edition_id',
                ], $merge);
    }
    
    public static function getEditions(){
        $edition = Edition::lists('edition_name_en', 'edition_id');
        return $edition;
    }
    
    public function articles() {
        return $this->hasMany('App\Article', 'edition_id', 'edition_id');
    }

}
