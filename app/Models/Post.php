<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug) || $model->isDirty('title')) {
                $model->slug = \Illuminate\Support\Str::slug($model->title);
            }
            if ($model->status === 'published' && empty($model->published_at)) {
                $model->published_at = now();
            }
        });
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
