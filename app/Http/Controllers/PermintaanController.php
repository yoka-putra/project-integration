<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aset;

class PermintaanController extends Controller
{
    public function formPermintaanServiceGantiPage()
    {
        return view('formPermintaanServiceGanti');
    }   

    public function getAllRequest()
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $permintaan = Permintaan::with(['user', 'aset'])->where('permintaan_nama_pengaju', $user->user_full_name)->get();

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function getRequest($id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }
    
        $permintaan = Permintaan::with(['user', 'aset'])
            ->where('id', $id)
            ->where('permintaan_nama_pengaju', $user->user_full_name)
            ->first();

        if (!$permintaan) {
            return response()->json([
                'success' => false,
                'message' => 'Permintaan not found or not authorized to view this resource',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }

    public function createRequest(Request $request)
{
    try {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        // Validasi data request
        $request->validate([
            'permintaan_nama_outlet' => 'required|string',
            'permintaan_nama_area' => 'nullable|string',
            'permintaan_tgl_pengajuan' => 'required|date',
            'permintaan_kategori' => 'required|string',
            'permintaan_status' => 'nullable|string',
            'permintaan_tujuan' => 'required|string',
            'permintaan_kuantitas' => 'nullable|integer',
            'permintaan_aset' => 'required|string', // hanya nama aset sebagai input
            'permintaan_keterangan' => 'nullable|string',
        ]);

        // Mengambil ID aset berdasarkan nama yang diberikan
        $aset = Aset::where('aset_name', $request->permintaan_aset)->first();

        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'Aset not found',
            ], 404);
        }

        // Membuat permintaan baru dengan user_id otomatis dari user yang sedang login
        $permintaan = Permintaan::create([
            'permintaan_nama_pengaju' => $user->user_full_name,
            'permintaan_nama_outlet' => $request->permintaan_nama_outlet,
            'permintaan_nama_area' => $request->permintaan_nama_area,
            'permintaan_tgl_pengajuan' => $request->permintaan_tgl_pengajuan,
            'permintaan_kategori' => $request->permintaan_kategori,
            'permintaan_status' => $request->permintaan_status,
            'permintaan_tujuan' => $request->permintaan_tujuan,
            'permintaan_kuantitas' => $request->permintaan_kuantitas,
            'permintaan_keterangan' => $request->permintaan_keterangan,
            'user_id' => $user->user_id, // otomatis dari user yang login
            'aset_id' => $aset->aset_id, // menyimpan ID aset
        ]);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors' => $e->errors(),
        ], 422);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the request.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
 
}
