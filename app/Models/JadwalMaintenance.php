<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMaintenance extends Model
{
    use HasFactory;

    protected $table = 'jadwal_maintenance';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = true;

    protected $fillable = [
        'klasifikasi_id',
        'tanggal_maintenance',
    ];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id', 'klasifikasi_id');
    }
}



