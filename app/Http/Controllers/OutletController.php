<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OutletController extends Controller
{
    public function getOutletAll()
{
    $user = Auth::guard('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized: Invalid token',
        ], 401);
    }

    try {
        // Eager load 'area' and 'users' relationships
        $outlets = Outlet::with(['area', 'users'])->get();

        return response()->json([
            'success' => true,
            'data' => $outlets
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve outlets',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function createOutlet(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

    
        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required|string|max:255|unique:outlet',
            'outlet_area' => 'required|integer|exists:area,area_id',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $outlet = Outlet::create([
            'outlet_name' => $request->input('outlet_name'),
            'outlet_area' => $request->input('outlet_area'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Outlet successfully created',
            'data' => $outlet,
        ], 200);
    }

    public function getOutlet($id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $outlet = Outlet::with('area', 'users')->find($id);

        if (!$outlet) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $outlet,
        ], 200);
    }

    
    public function updateOutlet(Request $request, $id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

    
        $validator = Validator::make($request->all(), [
            'outlet_name' => 'required|string|max:255|unique:outlet,outlet_name,' . $id,
            'outlet_area' => 'required|integer|exists:area,area_id',
        ]);

        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        
        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet not found',
            ], 404);
        }

        
        $outlet->update([
            'outlet_name' => $request->input('outlet_name'),
            'outlet_area' => $request->input('outlet_area'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Outlet successfully updated',
            'data' => $outlet,
        ], 200);
    }


    public function deleteOutlet($id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $outlet = Outlet::find($id);

        if (!$outlet) {
            return response()->json([
                'success' => false,
                'message' => 'Outlet not found',
            ], 404);
        }

        
        $outlet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Outlet successfully deleted',
        ], 200);
    }
}
