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
        // $year = ['2022', '2023', '2024', '2025', '2026'];
        // $keluhan = [];
        // $result = [];

        // foreach ($year as $key => $value) {

        //     $keluhan[] = Complaint::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();
        //     $result[] = Result::where(DB::raw("DATE_FORMAT(created_at, '%Y')"),$value)->count();


        // }


        // return view('home')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('keluhan',json_encode($keluhan,JSON_NUMERIC_CHECK))->with('result',json_encode($result,JSON_NUMERIC_CHECK));

        $groups = DB::table('result_complaints')
                  ->join('departements', 'result_complaints.departements_id', '=', 'departements.id')
                  ->join('complaints', 'result_complaints.complaints_id', '=', 'complaints.id')
                  ->select('asal_masalah','departements_id', DB::raw("DATE_FORMAT(complaints.tgl_keluhan, '%Y') year, count(*) as total"))
                  ->groupBy('year','departements_id')
                  ->pluck('total', 'asal_masalah')
                  ->all();
        // Generate random colours for the groups
        for ($i=0; $i<=count($groups); $i++) {
                    $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                }
        // Prepare the data for returning with the view
        $chart = new Result();
                $chart->labels = (array_keys($groups));
                $chart->dataset = (array_values($groups));
                $chart->colours = $colours;

        $now = Carbon::now()->format('d-m-Y, H:i:s');
        $thn = Carbon::now()->format('Y');
        $t_total = DB::table('result_complaints')->count();
        return view('home', compact('chart','now','thn', 't_total'));
    }
}