<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'phone_number', 
        'age', 
        'email', 
        'password', 
        'role_id', 
        'village', 
        'address', 
        'zipcode', 
        'image', 
        'city', 
        'province', 
        'deleted_at'
    ];
    public function adminlte_profile_url()
    {
        return route('profile.edit');  
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // app/Models/User.php
    
    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }
}

