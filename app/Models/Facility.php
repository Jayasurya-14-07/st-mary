<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_setting_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'feature_image',
        'show_below_slider',
        'order_by',
        'status',
    ];

    protected $casts = [
        'content' => 'array',
        'show_below_slider' => 'boolean',
        'status' => 'boolean',
    ];

    public function facilitySetting()
    {
        return $this->belongsTo(FacilitySetting::class, 'facility_setting_id');
    }

    public function getContentAttribute($value)
    {
        if (empty($value)) {
            return [];
        }
        if (is_array($value)) {
            return $value;
        }
        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return $decoded;
        }
        if (is_string($value)) {
            return [
                [
                    'type' => 'TipTap Editor',
                    'data' => [
                        'content' => $value,
                    ]
                ]
            ];
        }
        return [];
    }
}
