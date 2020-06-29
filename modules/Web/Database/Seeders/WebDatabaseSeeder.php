<?php

namespace Modules\Web\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WebDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $ctgs = factory(\Modules\Web\Models\BlogCategory::class, 5)->create();

        factory(\Modules\Web\Models\BlogPost::class, 10)->create()->each(function ($post) use ($ctgs) {
            $post->tags()->save(factory(\Modules\Web\Models\BlogPostTag::class)->make());
            $post->comments()->save(factory(\Modules\Web\Models\BlogPostComment::class)->make());
            if(rand(0, 1)) {
                $post->categories()->attach($ctgs->pluck('id')->random(rand(1,3))->all());
            }
        });
    }
}
