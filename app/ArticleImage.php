<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model {

    protected $primaryKey = 'article_image_id';

    public function article() {
        return $this->belongsTo('App\Article', 'article_id', 'article_id');
    }


}
