<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'aset';
    protected $primaryKey = 'aset_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'aset_name',
        'aset_merk',
        'aset_spesifikasi',
        'aset_klasifikasi',
        'aset_kondisi',
        'aset_pic',
        'aset_tgl_pembelian',
        'aset_tgl_maintenance',
        'aset_status',
        'klasifikasi_nilai_perolehan',
        'klasifikasi_nilai_buku_terakhir',
        'outlet_id',
        'aset_image',
        'nilai_penyusutan' 
    ];

    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'aset_klasifikasi');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }

    public function getUsiaAsetInMonthsAttribute()
    {
        if ($this->aset_tgl_pembelian) {
            $purchaseDate = Carbon::parse($this->aset_tgl_pembelian);
            $currentDate = Carbon::now();
            return $purchaseDate->diffInMonths($currentDate);
        }

        return null;
    }
    public function getNilaiPenyusutanAttribute()
    {
        if ($this->klasifikasi_nilai_perolehan && $this->klasifikasi) {
            $umurEkonomis = $this->klasifikasi->klasifikasi_nilai_ekonomis; 
            if ($umurEkonomis > 0) { 
                return $this->klasifikasi_nilai_perolehan / $umurEkonomis;
            }
        }

        return null;
    }

    public function getKlasifikasiNilaiBukuTerakhirAttribute()
    {
        $usiaAset = $this->usia_aset_in_months;
        $nilaiPenyusutan = $this->nilai_penyusutan;

        if ($this->klasifikasi_nilai_perolehan && $usiaAset !== null && $nilaiPenyusutan !== null) {
            return $this->klasifikasi_nilai_perolehan - ($nilaiPenyusutan * $usiaAset);
        }

        return null;
    }
}

