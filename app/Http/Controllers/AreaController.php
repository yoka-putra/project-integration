<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; 

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAreaAll', 'getArea']]);
    }

    public function getAreaAll()
    {
        $areas = Area::with('outlets')->get();
        return response()->json([
            'success' => true,
            'data' => $areas
        ], 200);
    }

    public function createArea(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'area_name' => 'required|string|max:255|unique:area',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $area = Area::create([
            'area_name' => $request->input('area_name'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Area successfully created',
            'data' => $area,
        ], 200);
    }

    public function getArea($id)
    {
        $area = Area::with('outlets')->find($id);

        if (!$area) {
            return response()->json([
                'success' => false,
                'message' => 'Area not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $area,
        ], 200);
    }

    public function updateArea(Request $request, $id)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'area_name' => 'required|string|max:255|unique:area,area_name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $area = Area::find($id);

        if (!$area) {
            return response()->json([
                'success' => false,
                'message' => 'Area not found',
            ], 404);
        }

        $area->update([
            'area_name' => $request->input('area_name'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Area successfully updated',
            'data' => $area,
        ], 200);
    }

    public function deleteArea($id)
    {

        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid token',
            ], 401);
        }

        $area = Area::find($id);

        if (!$area) {
            return response()->json([
                'success' => false,
                'message' => 'Area not found',
            ], 404);
        }

        $area->delete();

        return response()->json([
            'success' => true,
            'message' => 'Area successfully deleted',
        ], 200);
    }
}
