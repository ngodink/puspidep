<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    /**
     * The database table used by the model.
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'slug', 'name', 'metas', 'description'
    ];

    /**
     * The attributes that define value is a instance of carbon.
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Creates a new instance of the model.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'blog_categories';
    }

    /**
     * This belongsToMany posts.
     */
    public function posts () {
        return $this->belongsToMany(BlogPost::class, 'blog_post_categories', 'category_id', 'post_id');
    }
    
    /**
     * Scope find by slug.
     */
    public function scopeFindBySlug ($query, $slug) {
        return $query->where('slug', $slug)->first();
    }
    
    /**
     * Scope find by slug or fail.
     */
    public function scopeFindBySlugOrFail ($query, $slug) {
        return $query->where('slug', $slug)->firstOrFail();
    }
}
