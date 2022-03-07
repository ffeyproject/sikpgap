<?php

namespace App\Http\Controllers;

Use PDF;
use App\Http\Requests\ResultComplaintRequest;
use App\Models\Complaint;
use App\Models\Defect;
use App\Models\Departement;
use App\Models\Result;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Laravel\Ui\Presets\React;
use SebastianBergmann\Complexity\Complexity;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        $defect = Result::with('complaint','defect')->get();
        $ab = Defect::all();
        $ad = Departement::all();
        $ac = User::where('posisi', 'Qa' ,"Qa")->get();
        $result = Result::with('complaint','defect','departements')->where('complaints_id', '=', $id)->get();

        return view('keluhan.proses.index', compact('keluhan', 'defect', 'ab', 'ad', 'ac', 'result'));
    }

    public function status(Request $request, Complaint $complaint)
    {

        $complaint->status = 'closed';
        $complaint->update();
        return redirect()->back()->with('delete','Complaint Telah Di Close');
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
    public function store(Result $result, ResultComplaintRequest $request)
    {
        // $status = Complaint::where('id', '=', $id);
        // // $status = new Complaint();
        // $status->status = 'selesai';
        // $status->save();

        $result = new Result();
        $result->complaints_id = $request->complaints_id;
        $result->target_waktu = $request->target_waktu;
        $result->defects_id = $request->defects_id;
        $result->hasil_penelusuran = $request->hasil_penelusuran;
        $result->tindakan = $request->tindakan;
        $result->tgl_verifikasi = $request->tgl_verifikasi;
        $result->hasil_verifikasi = $request->hasil_verifikasi;
        $result->penyelidik = $request->penyelidik;
        $result->departements_id = $request->departements_id;
        $result->user_id = $request->penyelidik;
        $result->save();

        $status = Complaint::findOrFail($request->complaints_id);
        $status->status = 'selesai';
        $status->save();

        return redirect()->back()->with('info', 'Silahkan Closed Data Ini, Jika Sudah Terisi..');
    }


    public function closed(Request $request, Complaint $complaint)
    {
        $complaint->tgl_proses = Carbon::today();
        $complaint->status = 'proses';
        $complaint->update();
        return redirect()->back()->with('info','Complaint Telah Di Proses ...');
    }


    public function detail($id)
    {

        // $defect = Result::with('complaints','defect')->get();
        $ab = Defect::all();
        $ac = User::where('posisi', 'Admin' ,"Admin")->get();

        $defect = Defect::all();
        $user = User::all();
        $keluhan = Complaint::with('buyer')->findOrFail($id);
        $result = Result::with('complaint','defect')->where('complaints_id', '=', $id)->get();

        return view('keluhan.proses.detail', compact('defect', 'user', 'keluhan', 'result', 'ab', 'ac'));
    }

    public function cetak($id)
    {

        $defect = Defect::all();
        $user = User::all();
        $keluhan = Complaint::with('buyer')->findOrFail($id);
        $result = Result::with('complaint','defect', 'users')->where('complaints_id', '=', $id)->get();

       set_time_limit(600);

        $pdf = PDF::loadview('keluhan.proses.cetak', compact('defect','user','keluhan','result'))->setPaper('Legal', 'potrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();

      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result->delete();

         return redirect()->back()->with('delete', 'Data Result Berhasil Di Hapus');
    }
}