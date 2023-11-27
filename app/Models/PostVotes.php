<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostVotes extends Model
{
    use HasFactory;
    protected $table = 'post_votes';
    protected $fillable = [
        'user_id',
        'post_id',
        'vote'
    ];
}
