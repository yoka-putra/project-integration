<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\UpdateStatus; 

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

    // public static function updateMaintenanceSchedule()
    // {
    //     $jadwals = self::all();
        
    //     foreach ($jadwals as $jadwal) {
    //         $klasifikasi = $jadwal->klasifikasi;
            
    //         if ($klasifikasi) {
                
    //             $today = Carbon::now();
    //             // Get jenis_maintenance value (Bulanan, 2 Bulanan, etc.)
    //             $jenisMaintenance = $klasifikasi->jenis_maintenance;

    //             // Get the current maintenance date
    //             $maintenanceDate = Carbon::parse($jadwal->tanggal_maintenance);

    //             // Cek apakah ada pembaruan status maintenance antara tanggal 20-25
    //             $maintenanceStatusUpdated = UpdateStatus::where('aset_id', $jadwal->klasifikasi->aset_id)
    //                                                     ->whereBetween('tgl_update', [
    //                                                         $maintenanceDate->copy()->day(20),
    //                                                         $maintenanceDate->copy()->day(25)
    //                                                     ])
    //                                                     ->exists(); // Memeriksa apakah ada pembaruan status di rentang waktu tersebut
                
    //             // Jika sudah ada pembaruan status maintenance
    //             if ($maintenanceStatusUpdated) {
    //                 // Hitung tanggal maintenance selanjutnya berdasarkan jenis_maintenance
    //                 switch ($jenisMaintenance) {
    //                     case 'Bulanan':
    //                         $nextMaintenance = $maintenanceDate->addMonth(); // Next month
    //                         break;
    //                     case '2 Bulanan':
    //                         $nextMaintenance = $maintenanceDate->addMonths(2); // Next 2 months
    //                         break;
    //                     case '3 Bulanan':
    //                         $nextMaintenance = $maintenanceDate->addMonths(3); // Next 3 months
    //                         break;
    //                     case '6 Bulanan':
    //                         $nextMaintenance = $maintenanceDate->addMonths(6); // Next 6 months
    //                         break;
    //                     default:
    //                         continue 2; 
    //                 }

    //                 // Update the tanggal_maintenance
    //                 $jadwal->update([
    //                     'tanggal_maintenance' => $nextMaintenance->format('Y-m-d'),
    //                 ]);
    //             }
    //         }
    //     }
    // }

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;

// class JadwalMaintenance extends Model
// {
//     use HasFactory;

//     protected $table = 'jadwal_maintenance';
//     protected $primaryKey = 'id_jadwal';
//     public $timestamps = true;

//     protected $fillable = [
//         'klasifikasi_id',
//         'tanggal_maintenance',
//     ];

//     public function klasifikasi()
//     {
//         return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id', 'klasifikasi_id');
//     }

//     public static function updateMaintenanceSchedule()
//     {
//         //ambil semua data
//         $jadwals = self::all();
//         //baca semua jadwal
//         foreach ($jadwals as $jadwal) {
//             $klasifikasi = $jadwal->klasifikasi;
            
//             if ($klasifikasi) {
                
//                 $today = Carbon::now();
//                 // Get jenis_maintenance value (Bulanan, 2 Bulanan, etc.)
//                 $jenisMaintenance = $klasifikasi->jenis_maintenance;

//                 // Get the current maintenance date
//                 $maintenanceDate = Carbon::parse($jadwal->tanggal_maintenance);

//                 if ($today->between($maintenanceDate->copy()->day(20), $maintenanceDate->copy()->day(25))) {
//                     // Calculate next maintenance date
//                     switch ($jenisMaintenance) {
//                         case 'Bulanan':
//                             $nextMaintenance = $maintenanceDate->addMonth(); // Next month
//                             break;
//                         case '2 Bulanan':
//                             $nextMaintenance = $maintenanceDate->addMonths(2); // Next 2 months
//                             break;
//                         case '3 Bulanan':
//                             $nextMaintenance = $maintenanceDate->addMonths(3); // Next 3 months
//                             break;
//                         case '6 Bulanan':
//                             $nextMaintenance = $maintenanceDate->addMonths(6); // Next 6 months
//                             break;
//                         default:
//                             continue 2; 
//                     }

//                     $jadwal->update([
//                         'tanggal_maintenance' => $nextMaintenance->format('Y-m-d'),
//                     ]);
//                 }
//             }
//         }
//     }
// }
