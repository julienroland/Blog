<?php namespace Blog\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Translatable;

    public $translatedAttributes = ['title', 'slug', 'content'];
    protected $fillable = ['category_id', 'title', 'slug', 'content'];

    public function category()
    {
        return $this->hasOne('Blog\Entities\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('Blog\Entities\Tag');
    }
}
