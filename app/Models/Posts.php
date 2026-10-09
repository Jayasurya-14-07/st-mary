<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Storage;
use Str;

class Posts extends Model
{
    use HasFactory;

    protected $casts = [
        'content' => 'json',
    ];

    protected $appends = [
        'category_names',
        'slug_url'
    ];

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'feature_image',
        'author',
        'content',
        'status',
        'order_by',
        'publish_date',
        'created_at',
        'updated_at',
    ];

    public function getCategoryNamesAttribute(): string
    {
        return $this->categories
            ->pluck('name')
            ->implode(', ');
    }

    public function getSlugUrlAttribute(): string
    {
        return url('post/' . $this->slug);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function featuredImage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Media::class, 'feature_image', 'id');
    }

    public function mediaImage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Media::class, 'content', 'id');
    }

    public function multipleImage(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'posts', 'id');
    }

   protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            // Delete the featured image
            if ($post->feature_image && Storage::disk('public')->exists($post->feature_image)) {
                Storage::disk('public')->delete($post->feature_image);
            }

            // Delete all images in the `content` JSON field
            if (is_array($post->content)) {
                foreach ($post->content as $block) {
                    if (isset($block['url']) && Storage::disk('public')->exists($block['url'])) {
                        Storage::disk('public')->delete($block['url']);
                    }
                }
            }

            // Delete images from the `file-manager/post/image` directory
            $imageFiles = Storage::disk('public')->files('file-manager/post/image');
            foreach ($imageFiles as $image) {
                if (Str::contains($image, $post->id)) { // Optional: Delete files related to this post
                    Storage::disk('public')->delete($image);
                }
            }

            // Delete images from the `file-manager/post/images` directory
            $multipleImageFiles = Storage::disk('public')->files('file-manager/post/images');
            foreach ($multipleImageFiles as $image) {
                if (Str::contains($image, $post->id)) { // Optional: Delete files related to this post
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }

}