<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AsetController extends Controller
{
    public function masterAsetPage()
    {
        return view('masterAset');
    }
    public function addAsetPage()
    {
        return view('addAset');
    }
    public function daftarAsetPage()
    {
        return view('daftarAset');
    }
    public function qrGeneratePage()
    {
        return view('qrGenerate');
    }
    public function scanQrPage()
    {
        return view('scanQr');
    }
    public function updateAsetPage($id)
    {
        $aset = Aset::findOrFail($id);
        return view('updateAset', compact('aset'));
    }
    public function show($id)
    {
        $aset = Aset::findOrFail($id);
        return view('viewAset', compact('aset'));
    }
    
    public function createAset(Request $request)
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    try {
        $validator = Validator::make($request->all(), [
            'aset_name' => 'required|string|max:255',
            'aset_merk' => 'required|string|max:255',
            'aset_spesifikasi' => 'required|string',
            'aset_klasifikasi' => 'required|exists:klasifikasi,klasifikasi_id',
            'aset_kondisi' => 'nullable|string|max:50',
            'aset_pic' => 'required|string|max:255',
            'aset_tgl_pembelian' => 'required|date',
            'aset_status' => 'nullable|string|max:50',
            'klasifikasi_nilai_buku_terakhir' => 'nullable|numeric',
            'klasifikasi_nilai_perolehan' => 'required|numeric',
            'outlet_id' => 'required|exists:outlet,outlet_id',
            'aset_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validatedData = $validator->validated();

        if ($request->hasFile('aset_image')) {
            $imagePath = $request->file('aset_image')->store('aset_images', 'public');
            $validatedData['aset_image'] = $imagePath;
        }

        $klasifikasi = Klasifikasi::findOrFail($validatedData['aset_klasifikasi']);
        $validatedData['aset_tgl_maintenance'] = $klasifikasi->jadwal_maintenance;

        $aset = Aset::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Create Aset successfully',
            'aset' => $aset->fresh(['klasifikasi', 'outlet']),
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error creating aset: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to create Aset',
            'error' => $e->getMessage(),
        ], 500);
    }
}
    
public function getAsetAll()
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    $asets = Aset::with(['klasifikasi', 'outlet'])
        ->get()
        ->map(function ($aset) {
            $aset->usia_aset_in_months = $aset->usia_aset_in_months;
            return $aset;
        });

    return response()->json($asets);
}

public function getAset($id)
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    $aset = Aset::with(['klasifikasi', 'outlet'])->find($id);

    if (!$aset) {
        return response()->json(['message' => 'Aset tidak ditemukan'], 404);
    }

    return response()->json([
        'aset' => $aset,
        'usia_aset_in_months' => $aset->usia_aset_in_months,
    ]);
}
public function updateAset(Request $request, $id)
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    \Log::info('Incoming request data:', $request->all()); 

    try {
        $aset = Aset::find($id);
        if (!$aset) {
            return response()->json([
                'success' => false,
                'message' => 'Asset not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'aset_name' => 'sometimes|required|string|max:255',
            'aset_merk' => 'sometimes|required|string|max:255',
            'aset_spesifikasi' => 'sometimes|required|string',
            'aset_klasifikasi' => 'sometimes|required|exists:klasifikasi,klasifikasi_id',
            'aset_kondisi' => 'sometimes|nullable|string|max:50',
            'aset_pic' => 'sometimes|required|string|max:255',
            'aset_tgl_pembelian' => 'sometimes|required|date',
            'aset_status' => 'sometimes|nullable|string|max:50',
            'klasifikasi_nilai_buku_terakhir' => 'sometimes|nullable|numeric',
            'klasifikasi_nilai_perolehan' => 'sometimes|required|numeric',
            'outlet_id' => 'sometimes|required|exists:outlet,outlet_id',
            'aset_image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        try {
            $validatedData = $validator->validate();
        } catch (ValidationException $e) {
            \Log::error('Validation Exception: ', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation Exception',
                'error' => $e->errors(),
            ], 422);
        }        

        if ($request->hasFile('aset_image')) {
            $imagePath = $request->file('aset_image')->store('aset_images', 'public');
            $validatedData['aset_image'] = $imagePath;
        }

        $aset->update(array_filter($validatedData));

        if (isset($validatedData['aset_klasifikasi']) || isset($validatedData['klasifikasi_nilai_perolehan'])) {
        }

        return response()->json([
            'success' => true,
            'message' => 'Aset updated successfully',
            'aset' => $aset->fresh(['klasifikasi', 'outlet']),
        ], 200);
    } catch (\Exception $e) {
        \Log::error('Error updating aset: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to update Aset',
            'error' => $e->getMessage(),
        ], 500);
    }
}



// public function updateAset(Request $request, $id)
// {
//     $user = Auth::guard('api')->user();

//     if (!$user) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Unauthorized: Invalid token',
//         ], 401);
//     }

//     $aset = Aset::find($id);

//     if (!$aset) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Aset tidak ditemukan',
//         ], 404);
//     }

//     try {
//         $validator = Validator::make($request->all(), [
//             'aset_name' => 'sometimes|required|string|max:255',
//             'aset_merk' => 'sometimes|required|string|max:255',
//             'aset_spesifikasi' => 'sometimes|required|string',
//             'aset_klasifikasi' => 'sometimes|required|exists:klasifikasi,klasifikasi_id',
//             'aset_kondisi' => 'nullable|string|max:50',
//             'aset_pic' => 'sometimes|required|string|max:255',
//             'aset_tgl_pembelian' => 'sometimes|required|date',
//             'aset_tgl_maintenance' => 'sometimes|required|date',
//             'aset_status' => 'nullable|string|max:50',
//             'klasifikasi_nilai_buku_terakhir' => 'nullable|numeric',
//             'klasifikasi_nilai_perolehan' => 'sometimes|required|numeric',
//             'outlet_id' => 'sometimes|required|exists:outlet,outlet_id',
//             'aset_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Validation Error',
//                 'errors' => $validator->errors(),
//             ], 422);
//         }

//         $validatedData = $validator->validated();
//         \Log::info('Data to update:', $validatedData);

//         if ($request->hasFile('aset_image')) {
//             $imagePath = $request->file('aset_image')->store('aset_images', 'public');
//             $validatedData['aset_image'] = $imagePath;
//         }

//         if (isset($validatedData['aset_klasifikasi'])) {
//             $klasifikasi = Klasifikasi::findOrFail($validatedData['aset_klasifikasi']);
//             $validatedData['aset_tgl_maintenance'] = $klasifikasi->jadwal_maintenance;
//         }

//         $updateResult = $aset->update($validatedData);

//         if (!$updateResult) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Update failed: Data not updated',
//             ], 500);
//         }

//         return response()->json([
//             'success' => true,
//             'message' => 'Aset updated successfully',
//             'aset' => $aset->fresh(['klasifikasi', 'outlet']),
//         ], 200);
//     } catch (\Exception $e) {
//         \Log::error('Error updating aset: ' . $e->getMessage());
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to update Aset',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }


// public function updateAset(Request $request, $id)
// {
//     $user = Auth::guard('api')->user();
//     if (!$user) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Unauthorized: Invalid token',
//         ], 401);
//     }

//     $aset = Aset::find($id);
//     if (!$aset) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Aset tidak ditemukan',
//         ], 404);
//     }

//     try {
//         $validatedData = $request->validate([
//             'aset_name' => 'nullable|string|max:255',
//             'aset_merk' => 'nullable|string|max:255',
//             'aset_spesifikasi' => 'nullable|string',
//             'aset_klasifikasi' => 'nullable|exists:klasifikasi,klasifikasi_id',
//             'aset_kondisi' => 'nullable|string|max:50',
//             'aset_pic' => 'nullable|string|max:255',
//             'aset_tgl_pembelian' => 'nullable|date',
//             'aset_tgl_maintenance' => 'nullable|date',
//             'aset_status' => 'nullable|string|max:50',
//             'klasifikasi_nilai_buku_terakhir' => 'nullable|numeric',
//             'klasifikasi_nilai_perolehan' => 'nullable|numeric',
//             'outlet_id' => 'nullable|exists:outlet,outlet_id',
//             'aset_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);
//     } catch (\Illuminate\Validation\ValidationException $e) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Validation Error',
//             'errors' => $e->validator->errors(),
//         ], 422);
//     }

//     try {
//         // Lakukan update pada field yang diisi di request
//         $aset->fill($validatedData);
        
//         // Jika ada file gambar di-upload, simpan file dan perbarui path di atribut `aset_image`
//         if ($request->hasFile('aset_image')) {
//             $imagePath = $request->file('aset_image')->store('aset_images', 'public');
//             $aset->aset_image = $imagePath;
//         }

//         // Simpan semua perubahan
//         $aset->save();

//     } catch (\Exception $e) {
//         \Log::error('Failed to update aset: ' . $e->getMessage());
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed to update Aset',
//             'error' => $e->getMessage(),
//         ], 500);
//     }

//     // if ($request->hasFile('aset_image')) {
//     //     try {
//     //         $imagePath = $request->file('aset_image')->store('aset_images', 'public');
//     //         $aset->aset_image = $imagePath;
//     //         $aset->save();
//     //     } catch (\Exception $e) {
//     //         \Log::error('Failed to upload image: ' . $e->getMessage());
//     //         return response()->json([
//     //             'success' => false,
//     //             'message' => 'Failed to upload image',
//     //             'error' => $e->getMessage(),
//     //         ], 500);
//     //     }
//     // }

//     $aset->aset_tgl_maintenance = $validatedData['aset_tgl_maintenance'] ?? $aset->aset_tgl_maintenance; 
//     // $aset->nilai_penyusutan = $this->calculateDepreciation($aset); 
//     // $aset->klasifikasi_nilai_buku_terakhir = $this->calculateBookValue($aset); 

//     // try {
//     //     $aset->save();
//     // } catch (\Exception $e) {
//     //     \Log::error('Failed to save updated aset: ' . $e->getMessage());
//     //     return response()->json([
//     //         'success' => false,
//     //         'message' => 'Failed to save updated Aset',
//     //         'error' => $e->getMessage(),
//     //     ], 500);
//     // }

//     return response()->json([
//         'success' => true,
//         'message' => 'Aset berhasil diperbarui',
//         'aset' => $aset->fresh(['klasifikasi', 'outlet']),
//     ]);
// }

    public function deleteAset($id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }
        $aset = Aset::find($id);
        if (!$aset) {
            return response()->json(['message' => 'Aset tidak ditemukan'], 404);
        }
        $aset->delete();
        return response()->json(['message' => 'Aset berhasil dihapus']);
    }

    public function searchAset(Request $request)
{
    $user = Auth::guard('api')->user();
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
        
    }
    $validator = Validator::make($request->all(), [
        'query' => 'required|string|max:100',
    ]);
    $query = $request->input('query');
    $asets = Aset::where('aset_name', 'LIKE', '%' . $query . '%')
                 ->with(['klasifikasi', 'outlet']) 
                 ->get();
                 
    if ($asets->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Aset tidak ditemukan',
        ], 404);
    }
    return response()->json([
        'success' => true,
        'message' => 'Pencarian aset berhasil',
        'data' => $asets,
    ], 200);
}
}

