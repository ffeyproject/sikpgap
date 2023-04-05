<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartementStoreRequest;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $departement = Departement::all();

        return view('master.asal_masalah.index', [
            'departement' => $departement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.asal_masalah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartementStoreRequest $request)
    {
         $orderObj = DB::table('departements')->select('kode_asal')->latest('kode_asal')->first();
        if ($orderObj) {
            $orderNr = $orderObj->kode_asal;
            $removed1char = substr($orderNr, 3);
            $kasal = 'AM' . str_pad($removed1char + 1, 4, "0", STR_PAD_LEFT);
        } else {
            $kasal = "AM".str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $departement = new Departement();
        $departement->user_id = Auth::user()->id;
        $departement->kode_asal = $kasal;
        $departement->asal_masalah = $request->asal_masalah;
        $departement->keterangan = $request->keterangan;
        $departement->save();

        Alert::success('Congrats', 'Data Berhasil Ditambahkan');

        return redirect()->route('asal_masalah.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $departement = Departement::findOrFail($id);

        return view('master.asal_masalah.show', [
                'departement' => $departement
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departement = Departement::findOrFail($id);

        return view('master.asal_masalah.show', [
                'departement' => $departement
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(DepartementStoreRequest $request, Departement $departement)
    {
        $departement->asal_masalah = $request->asal_masalah;
        $departement->keterangan = $request->keterangan;
        $departement->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('asal_masalah.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
         $departement->delete();

          Alert::warning('Deleted', 'Data Asal Masalah Berhasil di Hapus');
        return redirect()->route('asal_masalah.index');
    }
}