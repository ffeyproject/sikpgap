<?php

namespace App\Http\Controllers;

Use PDF;
use App\Http\Requests\ResultComplaintRequest;
use App\Models\Complaint;
use App\Models\Defect;
use App\Models\Departement;
use App\Models\ImageComplaint;
use App\Models\Result;
use App\Models\User;
use App\Notifications\UpdateProsesEmailComplaint;
// use Carbon\Carbon;
use Carbon;
use Carbon\Doctrine\CarbonType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Js;
use Laravel\Ui\Presets\React;
use SebastianBergmann\Complexity\Complexity;
use RealRashid\SweetAlert\Facades\Alert;

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

        Alert::success('Success', 'Complaint Telah Di Close');

        return redirect()->back();
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
        $result->tindakan = "-";
        $result->tgl_verifikasi = null;
        $result->hasil_verifikasi = "-";
        $result->penyelidik = $request->penyelidik;
        $result->departements_id = $request->departements_id;
        $result->user_id = $request->penyelidik;
        $result->save();

        $status = Complaint::findOrFail($request->complaints_id);
        $status->status = 'selesai';
        $status->save();

        Alert::info('Info', 'Silahkan Isi Proses Ketahap berikutnya..');

        return redirect()->back();
    }


    public function closed(Request $request, Complaint $complaint)
    {
        $complaint->tgl_proses = Carbon::today();
        $complaint->status = 'proses';
        $complaint->update();

        $complaint->email = Auth::user()->email;

        $complaint->notify(new UpdateProsesEmailComplaint($complaint));

        Alert::info('Info', 'Complaint Telah Di Proses ...');
        return redirect()->back();
    }

    public function esolusi(Request $request, Complaint $complaint)
    {
         $this->validate($request, [
        'solusi'   => 'required'
        ]);


            $complaint->solusi = $request->solusi;
            $complaint->update();

            Alert::info('Info', 'Informasi Solusi Di Update ...');
            return redirect()->back();

    }

    public function print($id)
    {
        // $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        // $keluhan = Complaint::with('buyer')->findOrFail($id);
        // $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();




        // $pdf = PDF::loadview('keluhan.print', compact('icomplaint','keluhan'))
        // ->setPaper('Legal', 'potrait')
        // ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true ,'chroot' => public_path()]);
        // $pdf->getDomPDF()->setHttpContext(
        // stream_context_create([
        //     'ssl' => [
        //         'allow_self_signed'=> TRUE,
        //         'verify_peer' => FALSE,
        //         'verify_peer_name' => FALSE,
        //         ]
        //     ])
        // );
        //  set_time_limit(1200);

        // return $pdf->stream();

          $keluhan = Complaint::with('buyer')->findOrFail($id);

         $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();

        return view('keluhan.print', [
                'keluhan' => $keluhan,
                'icomplaint' => $icomplaint
        ]);


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
         $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();

        return view('keluhan.proses.detail', compact('defect', 'user', 'keluhan', 'result', 'ab', 'ac', 'icomplaint'));
    }

    public function cetak($id)
    {

        $defect = Defect::all();
        $user = User::all();
        $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        $result = Result::with('complaint','defect', 'users')->where('complaints_id', '=', $id)->get();





        $pdf = PDF::loadview('keluhan.proses.cetak', compact('defect','user','keluhan','result'))
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
         set_time_limit(1200);

        return $pdf->stream();

      }


      public function next(Request $request, Result $result)
      {

    //    $status = Complaint::findOrFail($request->complaints_id);
    //     $status->status = 'va';
    //     $status->update();

        $result = Result::findOrFail($request->id);
        $result->tindakan = $request->tindakan;
        $result->tgl_verifikasi = $request->tgl_verifikasi;
        $result->hasil_verifikasi = $request->hasil_verifikasi;
        $result->update();



        Alert::info('Info', 'Silahkan Close Form Jika Sudah Selesai !!');
        return redirect()->back();
      }

      public function selesai(Request $request, Result $result)
      {

       $result = Complaint::findOrFail($request->complaints_id);
        $result->status = 'va';
        $result->update();

        Alert::info('Info', 'Terimakasih, Data akan di Verifikasi');
        return redirect()->back();
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
        $this->validate($request, [
        'defects_id'   => 'required',
        'departements_id'   => 'required',
        'hasil_penelusuran'   => 'required',
        'hasil_verifikasi'   => 'required'
        ]);

        $result = Result::findOrFail($request->id);
        $result->defects_id = $request->defects_id;
        $result->departements_id = $request->departements_id;
        $result->hasil_penelusuran = $request->hasil_penelusuran;
        $result->hasil_verifikasi = $request->hasil_verifikasi;
        $result->update();

        Alert::info('Info', 'Proses Data Telah Di Update !!');
        return redirect()->back();
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

        Alert::warning('Deleted', 'Data Result Berhasil Di Hapus');

         return redirect()->back();
    }
}
