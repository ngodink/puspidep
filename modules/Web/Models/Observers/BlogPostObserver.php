<?php

namespace Modules\Web\Models\Observers;

use Str;
use Auth;
use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogPostMeta;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "saving" event.
     */
    public function saving(BlogPost $post)
    {
        $post->slug = Str::slug($post->title);
    }

    /**
     * Handle the BlogPost "saved" event.
     */
    public function saved(BlogPost $post)
    {
        if($post->metas()->doesntExist())
            $post->insertDefaultMetas($post);
    }
}