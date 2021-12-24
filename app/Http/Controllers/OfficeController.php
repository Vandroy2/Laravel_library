<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function show(Request $request): JsonResponse
    {
        $city_id = $request->get('city_id');

        $delivery_id = $request->get('delivery_id');

        $offices = Office::query()
            ->where('city_id', '=', $city_id)
            ->where('delivery_id', '=', $delivery_id)
            ->get();

        return response()->json([
            'status' => 'success',
            'offices' => $offices,
        ]);
    }
}
