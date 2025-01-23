<?php

namespace App\Models;
use App\Enums\UserRole ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{   
    
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
         'id' ,
        'name',
        'email',
        'password',
        'phone',
        'num',
        'role',
        'image_public_id',
        'image_url'
    ];

    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $casts = [
        'role' => UserRole::class
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === UserRole::SUPER_ADMIN;
    }

    public function isAdminProject(): bool
    {
        return $this->role === UserRole::ADMIN_PROJECT;
    }
}