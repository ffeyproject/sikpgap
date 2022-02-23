<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintRequest;
use App\Models\buyer;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ComplaintController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $complaint = Complaint::orderBy('id', 'DESC')->get();

        return view('keluhan.index', [
            'complaint' => $complaint
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buyer = Buyer::all();
        $user = User::where('posisi', '=' ,"marketing")->get();
        $keluhan = Complaint::with('Buyer','Users')->get();


        return view('keluhan.create', [
            'keluhan' => $keluhan,
            'user' => $user,
            'buyer' => $buyer
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintRequest $request)
    {
        //untuk membuat penomeran urut otomatis
         $orderObj = Complaint::whereYear("created_at",Carbon::now()->year)->count();
         $nn = $orderObj + 1;

        //untuk mengambil huruf jenis
          if ($request->jenis == 'Dyeing') {
                $i_jenis = 'D';
            }
            elseif ($request->jenis == 'Printing') {
                $i_jenis ='P';
            }
            else {
                $i_jenis = 'W';
            }

        //penomeran no_keluhan
          $romawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
            $cc = Complaint::whereYear("created_at",Carbon::now()->year)->count();
            $no = 0;
            if($cc) {
                $no_ak = sprintf("%02s", $cc+1). '/' . $i_jenis . '/' . $romawi[date('n')] .'/' . date('Y');
            }
            else {
                $no_ak = sprintf("%02s", $cc+1). '/' . $i_jenis . '/' . $romawi[date('n')] .'/' . date('Y');
            }

        $complaint = new Complaint();
        $complaint->user_id = Auth::user()->id;
        $complaint->buyers_id = $request->buyers_id;
        $complaint->no_urut = $nn;
        $complaint->nomer_keluhan = $no_ak;
        $complaint->tgl_keluhan = $request->tgl_keluhan;
        $complaint->nama_marketing = $request->nama_marketing;
        $complaint->no_wo = $request->no_wo;
        $complaint->no_sc = $request->no_sc;
        $complaint->nama_motif = $request->nama_motif;
        $complaint->cw_qty = $request->cw_qty;
        $complaint->jenis = $request->jenis;
        $complaint->masalah = $request->masalah;
        $complaint->solusi = $request->solusi;
        $complaint->save();

    //    return redirect('keluhan/proses/' .  $complaint->id)->with('info', 'Silahkan Proses Data Ini.');
       return redirect()->route('keluhan.index')->with('info', 'Data Tersimpan dan masuk ke tahap proses.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $keluhan = Complaint::with('buyer')->findOrFail($id);

        return view('keluhan.show', [
                'keluhan' => $keluhan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer = Buyer::all();
        $user = User::all();
        $keluhan = Complaint::with('buyer','users')->findOrFail($id);

        return view('keluhan.edit', [
                'keluhan' => $keluhan,
                'buyer' => $buyer,
                'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintRequest $request, Complaint $complaint)
    {
        $complaint->buyers_id = $request->buyers_id;
        $complaint->tgl_keluhan = $request->tgl_keluhan;
        $complaint->nama_marketing = $request->nama_marketing;
        $complaint->no_wo = $request->no_wo;
        $complaint->no_sc = $request->no_sc;
        $complaint->nama_motif = $request->nama_motif;
        $complaint->cw_qty = $request->cw_qty;
        $complaint->jenis = $request->jenis;
        $complaint->masalah = $request->masalah;
        $complaint->solusi = $request->solusi;
        $complaint->update();
        return redirect()->route('keluhan.index')->with('success','Data Telah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluhan=Complaint::find($id);
        $keluhan->delete();

         return redirect()->route('keluhan.index')->with('delete', 'Data Complaint Berhasil Di Hapus');
    }
}