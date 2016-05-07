<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveImage extends Model{
    
    protected $primaryKey = 'id_image';
        
//    public static function rules($id = 0, $merge = []) {
//        return array_merge([
//            'title_image_fr' => 'required|min:3',  
//            'title_image_en' => 'required|min:3',
//            'id_category' => 'required',
//            
//            'image' => 'required|Mimes:jpeg,png,gif',
//            
//                ], $merge);
//    }
    
    public function archivecategory() {
        return $this->belongsTo('App\ArchiveCategory', 'id_category', 'id_category');
    }
    
 }
