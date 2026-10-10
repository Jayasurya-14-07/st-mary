<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipMessage extends Model
{
    use HasFactory;

    protected $table = 'leadership_messages';

    protected $casts = [
        'content' => 'json',
        'status' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'slug',
        'position',
        'subtext',
        'icon',
        'feature_image',
        'excerpt',
        'content',
        'order_by',
        'status',
    ];
}
