<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $primaryKey = 'outlet_id';
    public $timestamps = true;
    protected $table = 'outlet';

    protected $fillable = [
        'outlet_name',
        'outlet_area',
    ];

    // Relasi dengan tabel area
    public function area()
    {
        return $this->belongsTo(Area::class, 'outlet_area');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'user_outlet_id');
    }
    
    
}
