<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopegetWithConditions($query, $param = NULL)
    {
        if(isset($param)){extract($param);}
        $conditions = [];
        if(isset($search_filter) && !empty($search_filter))
        {
          
            $query->where(function($query) use ($search_filter) {
              $query->where('name', 'LIKE', '%'.$search_filter.'%')
                  ->orWhere('email', 'LIKE', '%'.$search_filter.'%');
            });
        }

        $query->orderBy('id', 'DESC');
        return $query->where($conditions);

    }
}
