<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'status',
        'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);;
    }
    public function scopegetWithConditions($query, $param = NULL)
    {
        if(isset($param)){extract($param);}
        $conditions = [];
        if(isset($search_filter) && !empty($search_filter))
        {
          
            $query->where(function($query) use ($search_filter) {
              $query->where('title', 'LIKE', '%'.$search_filter.'%');
                  //->orWhere('', 'LIKE', '%'.$search_filter.'%');
            });
        }

        $query->orderBy('id', 'DESC');
        return $query->where($conditions);

    }
}
