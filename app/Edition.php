<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Edition extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $primaryKey = 'edition_id';
    protected $fillable = [
        'edition_name_en',
        'edition_name_fr',
    ];
    protected $sluggable = [
        'build_from' => 'edition_name_en',
        'save_to'    => 'edition_slug_en',
    ];


}
