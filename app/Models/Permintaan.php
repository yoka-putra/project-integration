<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'permintaan_nama_pengaju',
        'permintaan_nama_outlet',
        'permintaan_nama_area',
        'permintaan_tgl_pengajuan',
        'permintaan_kategori',
        'permintaan_status',
        'permintaan_tujuan',
        'permintaan_kuantitas',
        'permintaan_aset',
        'permintaan_keterangan',
        'permintaan_diajukan',
    ];

    // Relasi dengan tabel user (opsional, jika perlu)
    public function user()
    {
        return $this->belongsTo(User::class, 'permintaan_nama_pengaju', 'user_full_name');
    }
}
