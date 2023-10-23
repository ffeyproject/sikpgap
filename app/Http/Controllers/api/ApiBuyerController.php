<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\buyer;
use Illuminate\Http\Request;

class ApiBuyerController extends Controller
{
    function readAll()
    {
        $buyers = buyer::orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $buyers,
        ], 200);
    }
}
