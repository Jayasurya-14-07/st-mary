<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'excerpt',
        'feature_image',
        'content',
        'status',
        'order_by',
        'publish_date',
    ];

    protected $casts = [
        'content' => 'json',
        'publish_date' => 'date',
    ];

    public function getSlugUrlAttribute(): string
    {
        return url('news/' . $this->slug);
    }
}
