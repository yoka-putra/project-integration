<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    // Menetapkan nama kolom primary key
    protected $primaryKey = 'area_id';

    // Menetapkan apakah kolom primary key adalah auto-increment
    public $incrementing = true;

    // Menetapkan tipe data primary key
    protected $keyType = 'int';

    protected $fillable = [
        'area_name',
    ];

    // Relasi dengan tabel outlet
    public function outlets()
    {
        return $this->hasMany(Outlet::class, 'outlet_area');
    }
}
