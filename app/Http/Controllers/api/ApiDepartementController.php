<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;

class ApiDepartementController extends Controller
{
    function readAll()
    {
        $departements = Departement::orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $departements,
        ], 200);
    }
}
