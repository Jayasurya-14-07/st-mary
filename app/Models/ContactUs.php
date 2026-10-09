<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'job_title',
        'company_name',
        'industry',
        'country',
        'zip_code',
        'organ_modules',
        'application',
        'research_challenges',
        'help_message',
    ];
}