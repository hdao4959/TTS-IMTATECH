<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'link',
        'img_thumbnail',
        'post_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
