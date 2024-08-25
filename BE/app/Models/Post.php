<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'img_thumbnail',
        'description',
        'content',
        'view',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function post_status(){
        return $this->belongsTo(Post_status::class);
    }
}