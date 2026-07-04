<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'email',
        'phone',
        'address',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'whatsapp',
        'about',
        'opening_hours',
        'google_maps',
        'footer_text',
        'copyright',
    ];
}