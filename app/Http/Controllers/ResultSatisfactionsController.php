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
        // $rr = new ResultSatis();
        // $rr->satisfactions_id = $request->satisfactions_id;
        // $rr->satisfactions_id = implode(',', $request->satisfactions_id);
        // $rr->item_evaluations_id = implode(',', $request->item_evaluations_id);
        // $rr->score = implode(',', $request->score);
        // $rr->desc_kesesuaian = implode(',', $request->desc_kesesuaian);
        // $rr->kritik_saran = implode(',', $request->kritik_saran);
        // // $rr->item_evaluations_id = $request->item_evaluations_id;
        // // $rr->score = $request->score;
        // // $rr->desc_kesesuaian = $request->desc_kesesuaian;
        // // $rr->kritik_saran = $request->kritik_saran;
        // $rr->save();

        $data = $request->except('_token');

		$subject_count = count($data['item_evaluations_id']);
		for($i=0; $i < $subject_count; $i++){

			$abc = new ResultSatis();
			$abc->item_evaluations_id = $data['item_evaluations_id'][$i];
			$abc->satisfactions_id = $data['satisfactions_id'];
			$abc->score = $data['score'][$i];
			$abc->user_id = Auth::user()->id;
			// $abc->desc_kesesuaian = $data['desc_kesesuaian'];
			// $abc->kritik_saran = $data['kritik_saran'];
			$abc->save();

            
		}

        $status = Satisfaction::findOrFail($request->satisfactions_id);
        $status->desc_kesesuaian = $request->desc_kesesuaian;
        $status->kritik_saran = $request->kritik_saran;
        $status->r_nilai = '0';
        $status->status = 'Tersimpan';
        $status->save();

         return redirect()->back()->with('info', 'Silahkan Simpan Penilaian');
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