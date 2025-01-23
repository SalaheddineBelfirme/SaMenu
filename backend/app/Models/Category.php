<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id','menu_id', 'name',];
    public $incrementing = false;
    protected $keyType = 'string'; 
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
