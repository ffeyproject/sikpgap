<?php

namespace App\Http\Controllers\RawData;

use App\Http\Controllers\Controller;
use App\Models\buyer;
use App\Models\ItemEvalution;
use App\Models\RawSatisfaction;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function show(RawSatisfaction $rawSatisfaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RawSatisfaction  $rawSatisfaction
     * @return \Illuminate\Http\Response
     */
    public function edit(RawSatisfaction $rawSatisfaction)
    {
        //
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