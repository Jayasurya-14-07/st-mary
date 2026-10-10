<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'kicker',
        'title',
        'excerpt',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function facilities()
    {
        return $this->hasMany(Facility::class, 'facility_setting_id');
    }
}
