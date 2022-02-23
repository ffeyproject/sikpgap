<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $year = ['2022', '2023', '2024', '2025', '2026'];
        $keluhan = [];
        $result = [];

        foreach ($year as $key => $value) {

            $keluhan[] = Complaint::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
            $result[] = Result::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();


        }


        return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('keluhan',json_encode($keluhan,JSON_NUMERIC_CHECK))->with('result',json_encode($result,JSON_NUMERIC_CHECK));
    }
}