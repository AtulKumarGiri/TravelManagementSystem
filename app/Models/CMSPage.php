<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSPage extends Model
{
    // Explicitly specify the table name
    protected $table = 'cms_pages';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active'
    ];
}
