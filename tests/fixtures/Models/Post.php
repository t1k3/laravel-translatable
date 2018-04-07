<?php

namespace T1k3\LaravelTranslatable\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use T1k3\LaravelTranslatable\Models\Traits\Translatable;


/**
 * Class Post
 * @package T1k3\LaravelTranslatable\Tests\Fixture\Models
 */
class Post extends Model
{
    use Translatable;

    protected $fillable = [
        'title',
        'lead',
        'body',
    ];

    protected $translatable = [
        'title',
        'lead',
        'body',
    ];
}