<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\UpdateStatus;

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
        'aset_status',
        'klasifikasi_nilai_perolehan',
        'klasifikasi_nilai_buku_terakhir',
        'outlet_id',
        'aset_image',
        'nilai_penyusutan',
        'penanggungjawab'  
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

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($aset) {
            // Check if aset_status has changed
            if ($aset->isDirty('aset_status')) {
                // Save changes to update_status table
                UpdateStatus::create([
                    'aset_id' => $aset->aset_id,
                    'aset_status' => $aset->aset_status,
                    'tgl_update' => now(),
                ]);
            }
        });
    }

    public function updateStatuses()
    {
        return $this->hasMany(UpdateStatus::class, 'aset_id', 'aset_id');
    }

    public function jadwalMaintenance()
    {
        return $this->hasManyThrough(
            JadwalMaintenance::class, // Model to access
            Klasifikasi::class,       // Intermediate model
            'klasifikasi_id',         // Foreign key on klasifikasi table
            'klasifikasi_id',         // Foreign key on jadwal maintenance table
            'aset_klasifikasi',       // Local key on aset table
            'klasifikasi_id'          // Local key on klasifikasi table
        );
    }
}
