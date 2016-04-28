<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AdsSetting extends Model {
    
    protected $table = 'ads_setting';
    protected $primaryKey = 's_id';
    
     public static function rules($id = 0, $merge = []) {
        return array_merge([
            'section_position' => 'required',          
                ], $merge);
    }
    
}
