<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Section extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $primaryKey = 'section_id';
    protected $fillable = [
        'section_name_en',
        'section_name_fr',
    ];
    protected $sluggable = [
        'build_from' => 'section_name_en',
        'save_to' => 'section_slug_en',
    ];

    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'section_name_en' => 'required|min:3|unique:sections,section_name_en,' . ($id ? "$id" : 'NULL') . ',section_id',
            'section_name_fr' => 'required|min:3|unique:sections,section_name_fr,' . ($id ? "$id" : 'NULL') . ',section_id',
                ], $merge);
    }
    
    public static function getSections(){
        $section = Section::lists('section_name_en', 'section_id');
        return $section;
    }
    
    public function articles() {
        return $this->hasMany('App\Article', 'section_id', 'section_id');
    }

}
