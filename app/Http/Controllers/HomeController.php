<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Defect;
use App\Models\Departement;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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
         $yearNow = date('Y'); // Mendapatkan tahun sekarang dengan PHP

        $groups = DB::table('result_complaints')
                  ->join('departements', 'result_complaints.departements_id', '=', 'departements.id')
                  ->join('complaints', 'result_complaints.complaints_id', '=', 'complaints.id')
                  ->select('asal_masalah','departements_id', DB::raw("DATE_FORMAT(complaints.tgl_keluhan, '%Y') year, count(*) as total"))
                  ->whereRaw("DATE_FORMAT(tgl_keluhan, '%Y') = ?", [$yearNow]) // Menambahkan filter untuk tahun sekarang
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

        $total2 = array_sum($chart->dataset);
        $chart->total = $total2;



        $ab = DB::table('result_complaints')
                ->join('defects', 'result_complaints.defects_id', '=', 'defects.id')
                ->join('complaints', 'result_complaints.complaints_id', '=', 'complaints.id')
                ->select('defects.nama', 'defects_id', DB::raw("DATE_FORMAT(tgl_keluhan, '%Y') as year, count(*) as total"))
                ->whereRaw("DATE_FORMAT(tgl_keluhan, '%Y') = ?", [$yearNow]) // Menambahkan filter untuk tahun sekarang
                ->groupBy('year', 'defects_id')
                ->orderBy('total')
                ->havingRaw('count(*) >= ?', [3])
                ->pluck('total', 'nama')
                ->all();

        $cc = [];
        for ($i = 0; $i < count($ab); $i++) {
            $cc[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        // Prepare the data for returning with the view
        $ac = new Result();
        $ac->labels = array_keys($ab);
        $ac->dataset = array_values($ab);
        $ac->cc = $cc;

        $total = array_sum($ac->dataset);
        $ac->total = $total;

        $now = Carbon::now()->format('d-m-Y, H:i:s');
        $thn = Carbon::now()->format('Y');

        $t_total = DB::table('result_complaints')
                  ->join('departements', 'result_complaints.departements_id', '=', 'departements.id')
                  ->join('complaints', 'result_complaints.complaints_id', '=', 'complaints.id')
                  ->select( 'tgl_keluhan')
                ->whereYear('tgl_keluhan',  Carbon::now()->year)
                ->count();

      $t_keluhan = Complaint::whereYear('created_at','=',Carbon::now()->year)
                ->select('created_at')
                ->count();


        return view('home', compact('chart','now','thn', 't_total', 'ac', 't_keluhan'));
    }

     public function detail()
    {
        $thn = Carbon::now()->format('Y');


       $result = Result::select('result_complaints.*')
    ->join('complaints', 'complaints.id', '=', 'complaints_id')
    ->join('defects', 'defects.id', '=', 'defects_id')
    ->join('buyers', 'buyers.id', '=', 'buyers_id')
    ->select('result_complaints.*',
    'complaints.*',
    'buyers.nama_buyer',
    'defects.nama')
    ->orderBy('departements_id', 'DESC')
    // ->whereYear('result_complaints.created_at','=',Carbon::now()->year)
    // ->groupBy('departements_id')
    ->get();


        $defect = Result::with('complaint','defect')->get();
        $ab = Defect::all();
        $ad = Departement::first();
        $ac = User::where('posisi', 'Qa' ,"Qa")->get();
        // $result = Result::with('complaint','defect','departements')->whereYear('created_at','=',Carbon::now()->year)->get();
        $coba = Result::with('complaint','defect','departements')->where('departements_id', '=', '6')->get();

        return view('home_detail', compact('defect', 'ab', 'ad', 'ac', 'result','coba'));
    }


    public function grafik()
    {
        // Tampilkan view dengan form pencarian tanpa grafik
        return view('home_grafik');
    }

    public function search(Request $request)
{
    $tahun = $request->tahun;
    $kategori = $request->kategori; // Mendapatkan input kategori

    // Query dasar
    $query = DB::table('result_complaints')
                  ->join('defects', 'result_complaints.defects_id', '=', 'defects.id')
                  ->join('complaints', 'result_complaints.complaints_id', '=', 'complaints.id')
                  ->select('defects.nama as nama', DB::raw("DATE_FORMAT(tgl_keluhan, '%Y') as year, count(*) as total"))
                  ->whereRaw("DATE_FORMAT(tgl_keluhan, '%Y') = ?", [$tahun]);

    // Menambahkan filter berdasarkan kategori jika kategori bukan "Semua"
    if ($kategori !== "Semua") {
        $query->where('complaints.kategori_keluhan', '=', $kategori);
    }
    $dataBulanan = clone $query; // Clone query dasar atau yang sudah ditambahkan filter kategori
    $dataBulanan = $dataBulanan->select(DB::raw("DATE_FORMAT(tgl_keluhan, '%m') as month"), DB::raw("count(*) as total"))
                                ->groupBy('month')
                                ->orderBy('month', 'asc')
                                ->get();

    // Mengkonversi hasil query ke format yang sesuai untuk chart
    $bulanLabels = $dataBulanan->pluck('month')->map(function($month) {
        return DateTime::createFromFormat('m', $month)->format('F');
    });

    $data = $query->groupBy('year', 'defects.nama')
                  ->orderBy('total', 'desc')
                  ->get();


    $labels = $data->pluck('nama');
    $values = $data->pluck('total');


    $bulanValues = $dataBulanan->pluck('total');

    return view('home_grafik', compact('labels', 'values', 'tahun', 'kategori', 'bulanLabels', 'bulanValues'));
}
}
