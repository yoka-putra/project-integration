<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\jadwal_maintenance;
use Carbon\Carbon;

class UpdateMaintenanceDate extends Command
{
    protected $signature = 'maintenance:update-date';
    protected $description = 'Update tanggal_maintenance setiap bulan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $maintenances = JadwalMaintenance::all();

        foreach ($maintenances as $maintenance) {
            // Ambil tanggal_maintenance dan tambahkan 1 bulan
            $newDate = Carbon::parse($maintenance->tanggal_maintenance)->addMonth();

            // Simpan record baru dengan tanggal maintenance yang diperbarui
            JadwalMaintenance::create([
                'klasifikasi_id' => $maintenance->klasifikasi_id,
                'tanggal_maintenance' => $newDate->format('Y-m-d'),
            ]);
        }

        $this->info('Tanggal maintenance diperbarui setiap bulan');
    }
}
