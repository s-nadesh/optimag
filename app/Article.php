<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $primaryKey = 'article_id';

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
