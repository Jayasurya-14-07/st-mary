<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashNews extends Model
{
    use HasFactory;

    protected $table = 'flash_news';

    protected $fillable = [
        'title',
        'slug',
        'link',
        'open_in_new_tab',
        'status',
        'publish_date',
    ];

    protected $casts = [
        'status' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'publish_date' => 'date',
    ];

    /**
     * Scope for active news items that should be displayed.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true)
                     ->whereDate('publish_date', '<=', now());
    }
}
