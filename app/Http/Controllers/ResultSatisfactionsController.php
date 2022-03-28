<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResulSatisfactionRequest;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
			// $abc->desc_kesesuaian = $data['desc_kesesuaian'];
			// $abc->kritik_saran = $data['kritik_saran'];
			$abc->save();
		}

        $status = Satisfaction::findOrFail($request->satisfactions_id);
        $status->desc_kesesuaian = $request->desc_kesesuaian;
        $status->kritik_saran = $request->kritik_saran;
        $status->status = 'closed';
        $status->save();

         return redirect()->back()->with('info', 'Data Penilaian Tersimpan');
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
