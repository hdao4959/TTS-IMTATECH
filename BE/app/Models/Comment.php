<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'is_approved'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
