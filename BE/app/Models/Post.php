<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "title",
        'body',
        'img',
        'writer',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
