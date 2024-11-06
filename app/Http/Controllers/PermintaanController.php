<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function formPermintaanPage()
    {
        return view('formPermintaan');
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
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $request->validate([
            'permintaan_nama_outlet' => 'required|string',
            'permintaan_nama_area' => 'required|string',
            'permintaan_tgl_pengajuan' => 'required|date',
            'permintaan_kategori' => 'required|string',
            'permintaan_status' => 'required|string',
            'permintaan_tujuan' => 'required|string',
            'permintaan_kuantitas' => 'required|integer',
            'permintaan_aset' => 'required|integer|exists:aset,id',
            'permintaan_keterangan' => 'nullable|string',
        ]);

        $permintaan = Permintaan::create([
            'permintaan_nama_pengaju' => $user->user_full_name,
            'permintaan_nama_outlet' => $request->permintaan_nama_outlet,
            'permintaan_nama_area' => $request->permintaan_nama_area,
            'permintaan_tgl_pengajuan' => $request->permintaan_tgl_pengajuan,
            'permintaan_kategori' => $request->permintaan_kategori,
            'permintaan_status' => $request->permintaan_status,
            'permintaan_tujuan' => $request->permintaan_tujuan,
            'permintaan_kuantitas' => $request->permintaan_kuantitas,
            'permintaan_aset' => $request->permintaan_aset,
            'permintaan_keterangan' => $request->permintaan_keterangan,
            'permintaan_diajukan' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $permintaan,
        ]);
    }
}
