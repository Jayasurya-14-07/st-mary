<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    use HasFactory;

    protected $table = 'popups';

    protected $fillable = [
        'title',
        'content',
        'image',
        'link',
        'target',
        'status',
        'order_by',
        'publish_date',
    ];

    protected $casts = [
        'status' => 'boolean',
        'publish_date' => 'date',
    ];
}