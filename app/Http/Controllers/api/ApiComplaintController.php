<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Result;
use Illuminate\Http\Request;

class ApiComplaintController extends Controller
{
    function readComplaint()
    {
        // $complaints = Complaint::orderBy('id', 'DESC')->get();

        // return response()->json([
        //     'data' => $complaints,
        // ], 200);

        $complaints = Complaint::orderBy('created_at', 'desc')
            ->limit(20)
            ->with('buyer')
            ->get();

        if (count($complaints) > 0) {
            return response()->json([
                'data' => $complaints,
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
                'data' => $complaints,
            ], 404);
        }
    }

     function resultComplaint($id)
    {
         $result = Result::where('complaints_id', '=', $id)
            ->with('complaint', 'defect', 'departements')
            ->get();

        if (count($result) > 0) {
            return response()->json([
                'data' => $result,
            ], 200);
        } else {
            return response()->json([
                'message' => 'not found',
                'data' => $result,
            ], 404);
        }
    }

}
