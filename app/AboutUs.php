<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model {

    protected $table = 'about_us';
    protected $primaryKey = 'about_us_id';
    
    public static function rules($id = 0, $merge = []) {
        return array_merge([
            'content_fr' => 'required',
            'content_en' => 'required',
                ], $merge);
    }
    
}
