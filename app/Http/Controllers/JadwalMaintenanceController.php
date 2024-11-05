<?php

namespace App\Http\Controllers;

use App\Models\JadwalMaintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JadwalMaintenanceController extends Controller
{
    public function Jadwal(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'klasifikasi_id' => 'required|exists:klasifikasi,klasifikasi_id',
            'tanggal_maintenance' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $tanggalMaintenance = \Carbon\Carbon::parse($request->tanggal_maintenance);

        $jadwal = JadwalMaintenance::create([
            'klasifikasi_id' => $request->klasifikasi_id,
            'tanggal_maintenance' => $tanggalMaintenance,
        ]);

        return response()->json([
            'success' => true,
            'data' => $jadwal
        ], 201);
    }
}
