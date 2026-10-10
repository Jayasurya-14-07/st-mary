<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $table = 'video_gallery';

    protected $fillable = [
        'title',
        'link',
        'publish_date',
        'order_by',
        'status',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'status' => 'boolean',
    ];
}