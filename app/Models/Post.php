<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'expert',
        'body',
        'is_published',
        'published_at',
        'user_id',
        ];
    
        protected $casts = [
            'is_published' => 'boolean',
        ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
