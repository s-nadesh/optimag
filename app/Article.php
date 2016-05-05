<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model {

    protected $primaryKey = 'article_id';
    
     public static function rules($id = 0, $merge = []) {
        return array_merge([
            'title'       => 'required|min:3',  
            'description' => 'required|min:10', 
                ], $merge);
    }
    
    
    public static function get_article_title($article_key,$lang){
        
        $lang = ($lang=="en")?"fr":"en";
        
        $article_name = DB::table('articles')
                        ->where('article_key', $article_key)
                        ->where('language', $lang)
                        ->pluck('title');
        return $article_name;
    }

    public function edition() {
        return $this->belongsTo('App\Edition', 'edition_id', 'edition_id');
    }
    
    public function section() {
        return $this->belongsTo('App\Section', 'section_id', 'section_id');
    }
    
    public function articleImages() {
        return $this->hasMany('App\ArticleImage', 'article_id', 'article_id');
    }

}
