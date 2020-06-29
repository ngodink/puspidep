<?php

namespace Modules\Web\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'slug', 'img', 'title', 'content', 'author_id', 'commentable', 'visibled', 'views_count', 'published_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'author_id'
    ];

    /**
     * The attributes that define value is a instance of carbon.
     */
    protected $dates = [
        'published_at', 'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that define value is a instance of carbon.
     */
    protected $withCount = [
        'comments'
    ];

    /**
     * Creates a new instance of the model.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'blog_posts';
    }

    /**
     * Retrieve the model for a bound value.
     */
    public function resolveRouteBinding($value, $field = NULL)
    {
        return $this->withTrashed()->where($this->getRouteKeyName(), $value)->first();
    }

    /**
     * This belongsTo author.
     */
    public function author () {
        return $this->belongsTo(\Modules\Account\Models\User::class, 'author_id');
    }

    /**
     * This belongsToMany likes.
     */
    public function likes () {
        return $this->belongsToMany(\Modules\Account\Models\User::class, 'blog_post_likes', 'post_id', 'liker_id');
    }

    /**
     * This hasMany comments.
     */
    public function comments () {
        return $this->hasMany(BlogPostComment::class, 'post_id');
    }

    /**
     * This hasMany unpublished comments.
     */
    public function unpublishedComments () {
        return $this->comments()->whereNull('published_at');
    }

    /**
     * This belongsToMany categories.
     */
    public function categories () {
        return $this->belongsToMany(BlogCategory::class, 'blog_post_categories', 'post_id', 'category_id');
    }

    /**
     * This first category.
     */
    public function category () {
        return $this->categories()->first() ?: null;
    }

    /**
     * This hasMany tags.
     */
    public function tags () {
        return $this->hasMany(BlogPostTag::class, 'post_id');
    }

    /**
     * This hasMany metas.
     */
    public function metas () {
        return $this->hasMany(BlogPostMeta::class, 'post_id');
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

    /**
     * Scope where published.
     */
    public function scopePublished ($query) {
        return $query->whereNotNull('published_at')->whereDate('published_at', '<=', now());
    }

    /**
     * Scope where unpublished.
     */
    public function scopeUnpublished ($query) {
        return $query->whereNull('published_at')->orWhere(function ($term) {
            return $term->scheduled();
        });
    }

    /**
     * Scope where scheduled.
     */
    public function scopeScheduled ($query) {
        return $query->whereDate('published_at', '>', now());
    }

    /**
     * Scope where authored by.
     */
    public function scopeAuthoredBy ($query, $id) {
        return $query->whereIn('author_id', (array) $id);
    }

    /**
     * Get meta.
     */
    public function getMetas () {
        return $this->metas ?? [];
    }

    /**
     * Get meta.
     */
    public function getMeta ($key) {
        return $this->metas()->findByKey($key)->content ?? null;
    }

    /**
     * Set meta.
     */
    public function setMeta ($key, $value) {
        $this->metas()->updateOrCreate(['key' => $key], ['content' => $value]);
        return $this;
    }
    
    /**
     * Querying the default metas.
     */
    public function insertDefaultMetas() {
        $metas = [];
        foreach ((new \Modules\Web\Metas\BlogPostMeta())->defaultMetas($this) as $key => $content) {
            $metas[] = compact('key', 'content');
        }

        $this->metas()->createMany($metas);
        return $this;
    }

    /**
     * Scope where tag is.
     */
    public function scopeWhereTag ($query, $tag) {
        return $query->whereHas('tags', function ($tags) use ($tag) {
            return $tags->where('name', $tag);
        });
    }

    /**
     * Scope where tag is.    
     */
    public function scopeWhereLikedBy ($query, $id) {
        return $query->whereHas('likes', function ($tags) use ($id) {
            return $tags->where('liker_id', (array) $id);
        });
    }

    /**
     * Scope where category is.
     */
    public function scopeWhereCategoryIn ($query, $id) {
        return $query->whereHas('categories', function ($categories) use ($id) {
            return $categories->whereIn('id', (array) $id);
        });
    }

    /**
     * Increment views.
     */
    public function incrementViews () {
        if(!in_array($this->id, session('viewed_posts', []))) {
            session()->push('viewed_posts', $this->id);
            $this->increment('views_count');
        }
    }

    /**
     * Transform content
     */
    public static function makeContent ($input, $defpath = '/blogs/') {
        $defpath = (string) ('/blogs/'.date('Ymd').'/');

        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHtml($input, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = $defpath . uniqid('', true) . '.' . $mimeType;
                Storage::put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $image->setAttribute('src', Storage::url($path));
            }
        }

        libxml_clear_errors();

        return $dom->savehtml();
    }

    /**
     * Scope get latest published post.
     */
    public function scopeGetLatestPublishedPost ($query, $limit = 5) {
        return $query->published()
                     ->orderByDesc('published_at')
                     ->orderByDesc('created_at')
                     ->limit($limit)
                     ->get();
    }

    /**
     * Scope get related posts by category.
     */
    public function scopeGetRelatedPostsByCategory ($query, BlogPost $post, BlogCategory $category, $limit = 5) {
        return $query->inRandomOrder()
                     ->whereHas('categories', function ($subquery) use ($category) {
                        return $subquery->where('id', $category->id);
                     })
                     ->where('id', '!=', $post->id)
                     ->limit($limit)
                     ->get();
    }

    /**
     * Scope get most viewed posts.
     */
    public function scopeGetMostViewedPosts ($query, $limit = 5) {
        return $query->orderByDesc('views_count')
                     ->limit($limit)
                     ->get();
    }
}
