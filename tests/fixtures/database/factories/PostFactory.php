<?php

use Faker\Generator as Faker;
use T1k3\LaravelTranslatable\Tests\Fixtures\Models\Post;

$factory = app()->make(\Illuminate\Database\Eloquent\Factory::class);

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => [
            'en' => 'Lorem ipsum (en)',
            'hu' => 'Lorem ipsum (hu)'
        ]
    ];
});