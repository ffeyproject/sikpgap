<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemEvaluationRequest;
use App\Models\ItemEvalution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $item = ItemEvalution::all();

        return view('kepuasan.item.index', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('kepuasan.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemEvaluationRequest $request)
    {
        $orderObj = DB::table('item_evaluations')->select('kode_item')->latest('kode_item')->first();
        if ($orderObj) {
            $orderNr = $orderObj->kode_item;
            $removed1char = substr($orderNr, 4);
            $kItem = 'IP' . str_pad($removed1char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $kItem = "IP".str_pad(1, 5, "0", STR_PAD_LEFT);
        }

        $item = new ItemEvalution();
        $item->user_id = Auth::user()->id;
        $item->kode_item = $kItem;
        $item->nama_penilaian = $request->nama_penilaian;
        $item->keterangan = $request->keterangan;
        $item->save();

        return redirect()->route('item.index')->with('success', 'Item Evaluasi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemEvalution  $itemEvalution
     * @return \Illuminate\Http\Response
     */
    public function show(ItemEvalution $itemEvalution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemEvalution  $itemEvalution
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item = ItemEvalution::findOrFail($id);

        return view('kepuasan.item.edit', [
                'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemEvalution  $itemEvalution
     * @return \Illuminate\Http\Response
     */
    public function update(ItemEvaluationRequest $request, ItemEvalution $item)
    {
        $item->nama_penilaian = $request->nama_penilaian;
        $item->keterangan = $request->keterangan;
        $item->update();
        return redirect()->route('item.index')->with('success','Data Telah Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemEvalution  $itemEvalution
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemEvalution $itemEvalution)
    {
        //
    }
}