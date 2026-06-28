<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'hero_title', 'hero_subtitle', 'hero_image', 'hero_images',
        'site_logo', 'company_name', 'company_address', 
        'company_email', 'company_whatsapp', 'social_instagram', 'social_facebook',
        'banner_produk', 'banner_proyek', 'banner_tentang', 'banner_blog', 'banner_kontak'
    ];

    protected $casts = [
        'hero_images' => 'array',
    ];
}
