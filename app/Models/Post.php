<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = ['id'];
    protected $hidden = [];
    // protected $timestamps = false;
    use HasFactory;
}
