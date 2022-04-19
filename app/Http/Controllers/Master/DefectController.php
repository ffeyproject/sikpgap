<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\DefectRequest;
use App\Models\Defect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DefectController extends Controller
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
         $defect = Defect::all();

        return view('master.defect.index', [
            'defect' => $defect
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.defect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DefectRequest $request)
    {
         $orderObj = DB::table('defects')->select('kode_defect')->latest('kode_defect')->first();
        if ($orderObj) {
            $orderNr = $orderObj->kode_defect;
            $removed1char = substr($orderNr, 4);
            $kdefect = 'D-' . str_pad($removed1char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $kdefect = "D-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }

        $defect = new Defect();
        $defect->user_id = Auth::user()->id;
        $defect->kode_defect = $kdefect;
        $defect->kategori = $request->kategori;
        $defect->nama = $request->nama;
        $defect->keterangan = $request->keterangan;
        $defect->save();

        Alert::success('Congrats', 'Data Berhasil Ditambahkan');

        return redirect()->route('defect.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $defect = Defect::findOrFail($id);

        return view('master.defect.show', [
                'defect' => $defect
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DefectRequest $request, Defect $defect)
    {
        $defect->kategori = $request->kategori;
        $defect->nama = $request->nama;
        $defect->keterangan = $request->keterangan;
        $defect->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('defect.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defect $defect)
    {
        $defect->delete();

         Alert::warning('Deleted', 'Data Defect Berhasil di Hapus');
        return redirect()->route('defect.index');
    }
}