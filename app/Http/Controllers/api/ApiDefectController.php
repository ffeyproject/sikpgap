<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Defect;
use Illuminate\Http\Request;

class ApiDefectController extends Controller
{
    function readAll()
    {
        $defects = Defect::orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $defects,
        ], 200);
    }
}
