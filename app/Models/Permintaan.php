<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';
    protected $primaryKey = 'permintaan_id';
    public $incrementing = true;
    public $timestamps = true;

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
        'user_id', // Relasi dengan User
        'aset_id', // Relasi dengan Aset
        'lampiran', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id', 'id');
    }
}
