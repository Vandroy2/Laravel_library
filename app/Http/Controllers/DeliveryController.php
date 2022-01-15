<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\JsonResponse;

class DeliveryController extends Controller
{
    public function view(): JsonResponse
    {
        $deliveries = Delivery::all();

        return response()->json([

            'status' => 'success',
            'deliveries' => $deliveries,
        ]);
    }
}
