<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi';
    protected $primaryKey = 'klasifikasi_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'klasifikasi_nama',
        'klasifikasi_nilai_ekonomis',
        'jadwal_maintenance',
        'jenis_maintenance',
        'parameter_kesehatan_aset'
    ];

    public function jadwalMaintenance()
    {
        return $this->hasMany(JadwalMaintenance::class, 'klasifikasi_id', 'klasifikasi_id');
    }
}
