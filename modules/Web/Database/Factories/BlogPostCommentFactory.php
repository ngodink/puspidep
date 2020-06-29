<?php

use Modules\Web\Models\BlogPostComment;
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

$factory->define(BlogPostComment::class, function (Faker $faker) use ($ids){
    return [
        'content' => $faker->text($faker->numberBetween(50, 100)),
        'published_at' => $faker->boolean() ? $faker->dateTimeBetween('-1 year') : null,
        'commentator_id' => ($ids ?? null) ? ($faker->boolean() ? 1 : null) : null
    ];
});
