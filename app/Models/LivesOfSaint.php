<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivesOfSaint extends Model
{
    protected $table = 'lives_of_saints';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'feature_image',
        'subtitle',
        'link',
        'content',
        'status',
        'publish_date',
    ];

    protected $casts = [
        'content' => 'json',
        'status' => 'boolean',
        'publish_date' => 'date',
    ];

    public function getSlugUrlAttribute(): string
    {
        return url('lives-of-saints/' . $this->slug);
    }
}
