<?php

namespace Modules\Web\Models\Traits;

use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogPostComment;

trait UserTrait
{
    /**
     * This hasMany posts.
     */
    public function posts () {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /**
     * This hasMany comments.
     */
    public function post_comments () {
        return $this->hasMany(BlogPostComment::class, 'commentator_id');
    }

    /**
     * This belongsToMany liked_posts.
     */
    public function liked_posts () {
        return $this->belongsToMany(BlogPost::class, 'blog_post_likes', 'liker_id', 'post_id');
    }
}