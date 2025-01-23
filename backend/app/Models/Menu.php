<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'id',
        'colors',
        'logo',
        'user_id',
        'image_public_id',
        'image_url'
    ];

    public $incrementing = false;
    protected $keyType = 'string'; 
    public function adminProject()
    {
        return $this->belongsTo(User::class);
    }
}
