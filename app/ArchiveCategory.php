<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveCategory extends Model {

    protected $primaryKey = 'id_category';
    
    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'category_fr' => 'required|min:3',
            'category_en' => 'required|min:3',
                ], $merge);
    }
    
    public static function getArchiveCategory(){
        $category = ArchiveCategory::lists('category_en', 'id_category');
        return $category;
    }

}
