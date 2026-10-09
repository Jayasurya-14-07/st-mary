<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationSubmission extends Model
{
    protected $fillable = [
        'course_title_dates',
        'name',
        'email',
        'contact_address',
        'phone',
        'country',
        'date_of_birth',
        'diocese_congregation',
        'religious_theological_non_academic',
        'religious_theological_academic',
        'secular',
        'present_ministry',
        'interests',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }
}
