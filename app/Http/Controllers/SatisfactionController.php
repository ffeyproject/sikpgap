<?php

namespace App\Http\Controllers;

use App\Http\Requests\KepuasanRequest;
use App\Http\Requests\UpdateSatisfactionRequest;
use App\Models\buyer;
use App\Models\ItemEvalution;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SatisfactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kepuasan = Satisfaction::orderBy('id', 'DESC')->get();

        return view('kepuasan.index', [
            'kepuasan' => $kepuasan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $kepuasan = Satisfaction::all();
        // $buyer = DB::table("buyers")->select("id","nama_buyer","alamat_buyer","cp_buyer")->get();
        $buyer = buyer::pluck('nama_buyer', 'id');
        return view('kepuasan.create', compact('kepuasan', 'buyer'));
    }

   public function loadNyari(Request $request)
    {
        if ($request->has('q')) {
            $nyari = $request->q;
            $data = DB::table('satisfactions')->select('id', 'nama_buyer')->where('nama_buyer', 'LIKE', "%$nyari%")->get();
            return response()->json($data);
        }
    }

    public function getCustomerList(Request $request)
    {

        $alamat_buyer = buyer::where("id",$request->alamat_buyer)
        //  ->orWhere("id", $request->cp_buyer)
         ->orderBy('alamat_buyer')
    // ->get(['id','cp_buyer','alamat_buyer'])
    // ->pluck('alamat_buyer','id');
        //   ->pluckMany('alamat_buyer', 'id');
          ->pluck('alamat_buyer');
        //   ->first();
        $cp_buyer = buyer::where("id",$request->cp_buyer)
         ->orderBy('cp_buyer')
    // ->get(['id','cp_buyer','alamat_buyer'])
    // ->pluck('alamat_buyer','id');
        //   ->pluckMany('alamat_buyer', 'id');
          ->pluck('cp_buyer');
        //   ->all();

        // return response()->json($alamat_buyer);

        // $cp_buyer = buyer::where("id",$request->cp_buyer)
        //   ->pluck('buyers.cp_buyer' , 'buyers.id')
        //   ->all();

        return response()->json($alamat_buyer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KepuasanRequest $request)
    {
        //untuk membuat penomeran urut otomatis
         $orderObj = Satisfaction::whereYear("created_at",Carbon::now()->year)->count();
         $nn = $orderObj + 1;


        //penomeran no_keluhan
            $cc = Satisfaction::whereYear("created_at",Carbon::now()->year)->count();
            $no = 0;
            if($cc) {
                $no_ak = "B" .'-'. sprintf("%02s", $cc+1). '-' . date('Y');
            }
            else {
                $no_ak = "B" .'-'. sprintf("%02s", $cc+1). '-' . date('Y');
            }

        $kepuasan = new Satisfaction();
        $kepuasan->user_id = Auth::user()->id;
        $kepuasan->buyers_id = $request->buyers_id;
        $kepuasan->no_urut = $nn;
        $kepuasan->kode_penilaian = $no_ak;
        $kepuasan->nama_kontak = $request->nama_kontak;
        $kepuasan->alamat = $request->alamat;
        $kepuasan->tgl_penilaian = $request->tgl_penilaian;
        $kepuasan->desc_kesesuaian = '-';
        $kepuasan->kritik_saran = '-';
        $kepuasan->status = "open";
        $kepuasan->save();

        return redirect('kepuasan-penilaian/index/' .  $kepuasan->id)->with('info', 'Silahkan Isi Penilaian.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satisfaction  $satisfaction
     * @return \Illuminate\Http\Response
     */
    public function vpenilaian($id)
    {


        $item = ItemEvalution::all();
        $aq = Satisfaction::all();
        $buyer = Buyer::all();
        $kepuasan = Satisfaction::with('buyer', 'itemevaluation')->findOrFail($id);
        $detail = ResultSatis::with('satisfaction','itemevaluation')->where('satisfactions_id', '=', $id)->get();

        return view('kepuasan.penilaian.index', compact('kepuasan', 'detail', 'item', 'aq', 'buyer'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satisfaction  $satisfaction
     * @return \Illuminate\Http\Response
     */
    public function show(Satisfaction $satisfaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satisfaction  $satisfaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Satisfaction $satisfaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satisfaction  $satisfaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satisfaction $kepuasan)
    {
        $kepuasan->buyers_id = $request->buyers_id;
        $kepuasan->nama_kontak = $request->nama_kontak;
        $kepuasan->alamat = $request->alamat;
        $kepuasan->tgl_penilaian = $request->tgl_penilaian;
        $kepuasan->desc_kesesuaian = $request->desc_kesesuaian;
        $kepuasan->kritik_saran = $request->kritik_saran;
        $kepuasan->status = $request->status;
        $kepuasan->update();
        return redirect()->back()->with('success','Data Telah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satisfaction  $satisfaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Satisfaction $kepuasan)
    {
        $kepuasan->delete();
        return redirect()->route('kepuasan.index')->with('delete', 'Data Kepuasan Berhasil Di Hapus');
    }
}