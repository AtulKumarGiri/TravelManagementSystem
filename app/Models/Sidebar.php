<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sidebar extends Model
{
    protected $fillable = ['title', 'slug', 'icon', 'parent_id', 'level', 'status'];

    // Auto-generate slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($sidebar) {
            $sidebar->slug = Str::slug($sidebar->title);
        });
    }

    public function parent()
    {
        return $this->belongsTo(Sidebar::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Sidebar::class, 'parent_id');
    }
}
