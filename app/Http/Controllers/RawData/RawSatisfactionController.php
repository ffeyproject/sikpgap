<?php

namespace App\Http\Controllers\RawData;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintRequest;
use App\Models\buyer;
use App\Models\Complaint;
use App\Models\ImageClient;
use App\Models\ImageComplaint;
use App\Models\ItemEvalution;
use App\Models\RawSatisfaction;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RawSatisfactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kepuasan = Satisfaction::orderBy('id', 'DESC')->get();

        return view('raw.satisfaction.index', [
            'kepuasan' => $kepuasan
        ]);
    }

    public function view()
    {
         $complaint = Complaint::orderBy('id', 'DESC')->get();

        return view('raw.keluhan.index', [
            'complaint' => $complaint
        ]);
    }

    public function detail($id)
    {
        $item = ItemEvalution::all();
        $aq = Satisfaction::all();
        $buyer = buyer::all();
        $user = User::all();
        $nm = Satisfaction::with('users')->first();
        $kepuasan = Satisfaction::with('buyer', 'itemevaluation')->findOrFail($id);
        $detail = ResultSatis::with('satisfaction','itemevaluation')->where('satisfactions_id', '=', $id)->get();

        return view('raw.satisfaction.detail', compact('kepuasan', 'detail', 'item', 'aq', 'buyer', 'user','nm', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RawSatisfaction  $rawSatisfaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $keluhan = Complaint::with('buyer')->findOrFail($id);

         $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();

        return view('raw.keluhan.show', [
                'keluhan' => $keluhan,
                'icomplaint' => $icomplaint
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawSatisfaction  $rawSatisfaction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $buyer = Buyer::all();
        $user = User::all();
        $keluhan = Complaint::with('buyer','users')->findOrFail($id);

        return view('raw.keluhan.edit', [
                'keluhan' => $keluhan,
                'buyer' => $buyer,
                'user' => $user
        ]);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RawSatisfaction  $rawSatisfaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satisfaction $kepuasan)
    {
        $kepuasan->user_id = $request->user_id;
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

    public function urdkeluhan(ComplaintRequest $request, Complaint $keluhan)
    {
        {
        $keluhan->buyers_id = $request->buyers_id;
        $keluhan->tgl_keluhan = $request->tgl_keluhan;
        $keluhan->nama_marketing = $request->nama_marketing;
        $keluhan->no_wo = $request->no_wo;
        $keluhan->no_sc = $request->no_sc;
        $keluhan->nama_motif = $request->nama_motif;
        $keluhan->cw_qty = $request->cw_qty;
        $keluhan->jenis = $request->jenis;
        $keluhan->masalah = $request->masalah;
        $keluhan->solusi = $request->solusi;
        $keluhan->g_keluhan = 'default.png';

        $keluhan->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('raw-data.keluhan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RawSatisfaction  $rawSatisfaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(RawSatisfaction $rawSatisfaction)
    {
        //
    }
}