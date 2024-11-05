<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlasifikasiController extends Controller
{

    public function getKlasifikasiAll()
    {

        $user = Auth::guard('api')->user();
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401); 
        }
    
        try {
            $klasifikasis = Klasifikasi::all();
            return response()->json([
                'success' => true,
                'data' => $klasifikasis,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve klasifikasi',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }
    
    public function createKlasifikasi(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401); 
        }

        $validatedData = $request->validate([
            'klasifikasi_nama' => 'required|string|max:255',
            'klasifikasi_nilai_ekonomis' => 'nullable|numeric',
            'jadwal_maintenance' => 'nullable|date',
            'jenis_maintenance' => 'nullable|string|max:255',
            'parameter_kesehatan_aset' => 'nullable|string|max:5000',
        ]);

        try {
            $klasifikasi = Klasifikasi::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Klasifikasi created successfully',
                'data' => $klasifikasi,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create klasifikasi',
                'error' => $e->getMessage(),
            ], 500); 
        }
    }

    public function getKlasifikasi($id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        try {
            $klasifikasi = Klasifikasi::findOrFail($id); 
            return response()->json([
                'success' => true,
                'data' => $klasifikasi,
            ], 200); 
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Klasifikasi not found',
                'error' => $e->getMessage(),
            ], 404); 
        }
    }
}
