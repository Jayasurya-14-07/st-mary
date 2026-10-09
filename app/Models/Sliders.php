<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'link_title',
        'link',
        'slug',
        'image',
        'status',
        'order_by',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    /**
     * Handle the deletion of the slider's image file when the slider is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($slider) {
            if (!empty($slider->image)) {
                foreach ($slider->image as $image) {
                    if (\Storage::disk('public')->exists($image)) {
                        \Storage::disk('public')->delete($image);
                    } else {
                        \Log::warning('Image file not found: ' . $image);
                    }
                }
            }
        });
    }
}