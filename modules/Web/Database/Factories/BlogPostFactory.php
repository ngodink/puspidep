<?php

use Modules\Web\Models\BlogPost;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$ids = DB::table('users')->count();

$factory->define(BlogPost::class, function (Faker $faker) use ($ids) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->text(500),
        'commentable' => $faker->boolean(),
        'visibled' => $faker->boolean(),
        'published_at' => $faker->boolean() ? $faker->dateTimeBetween('-1 year') : null,
        'author_id' => ($ids ?? null) ? ($faker->boolean() ? 1 : null) : null,
    ];
});
