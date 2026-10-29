<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResulSatisfactionRequest;
use App\Models\buyer;
use App\Models\ItemEvalution;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use PDF;
use Carbon\Carbon;

class ResultSatisfactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ResulSatisfactionRequest $request)
    {
        $status = Satisfaction::findOrFail($request->satisfactions_id);
        if ($status->status == 'closed') {
            return redirect()->back()->with('error', 'Data penilaian ini sudah Closed dan tidak dapat diubah lagi.');
        }

        $data = $request->except('_token');
        $userId = Auth::id() ?? $status->users_id ?? 1;

        $subject_count = count($data['item_evaluations_id']);
        for ($i = 0; $i < $subject_count; $i++) {
            ResultSatis::updateOrCreate(
                [
                    'satisfactions_id' => $data['satisfactions_id'],
                    'item_evaluations_id' => $data['item_evaluations_id'][$i],
                ],
                [
                    'score' => $data['score'][$i] ?? 0,
                    'user_id' => $userId,
                ]
            );
        }

        $avgScore = ResultSatis::where('satisfactions_id', $request->satisfactions_id)->avg('score');

        $status->desc_kesesuaian = $request->desc_kesesuaian;
        $status->kritik_saran = $request->kritik_saran;
        $status->r_nilai = round($avgScore, 2);
        $status->status = 'Tersimpan';
        $status->save();

        return redirect()->back()->with('success', 'Data Penilaian Berhasil Disimpan / Diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResultSatis  $resultSatis
     * @return \Illuminate\Http\Response
     */
    public function show(ResultSatis $resultSatis)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResultSatis  $resultSatis
     * @return \Illuminate\Http\Response
     */
    public function cetak($id)
    {

        $aq = Satisfaction::all();
        $buyer = buyer::all();
        $kepuasan = Satisfaction::with('buyer', 'itemevaluation','users')->findOrFail($id);
        $detail = ResultSatis::with('satisfaction','itemevaluation')->where('satisfactions_id', '=', $id)->get();

       set_time_limit(600);



        $pdf = PDF::loadview('kepuasan.penilaian.cetak', compact('aq','buyer','kepuasan', 'detail'))
        ->setPaper('Legal', 'potrait')
        ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true ,'chroot' => public_path()]);
        $pdf->getDomPDF()->setHttpContext(
        stream_context_create([
            'ssl' => [
                'allow_self_signed'=> TRUE,
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                ]
            ])
        );
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResultSatis  $resultSatis
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultSatis $resultSatis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResultSatis  $resultSatis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultSatis $resultSatis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResultSatis  $resultSatis
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultSatis $resultSatis)
    {
        //
    }
}