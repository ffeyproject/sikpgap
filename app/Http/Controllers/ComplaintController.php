<?php

namespace App\Http\Controllers;

Use PDF;
use App\Http\Requests\ComplaintRequest;
use App\Models\buyer;
use App\Models\ChatPersonal;
use App\Models\Complaint;
use App\Models\ImageComplaint;
use App\Models\User;
use App\Notifications\CreateComplaintNotification;
use CreateComplaintsTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Result;
use App\Notifications\SendChatComplaintNotification;
use App\Notifications\UpdateProsesEmailComplaint;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use LDAP\Result as LDAPResult;
use PgSql\Result as PgSqlResult;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables;

class ComplaintController extends Controller
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
        $complaint = Complaint::with([
            'buyer:id,nama_buyer',
            'latestChatPersonal.users:id,name'
        ])
        ->select([
            'id', 'nomer_keluhan', 'tgl_keluhan', 'jenis', 'kategori_keluhan',
            'buyers_id', 'nama_marketing', 'tgl_proses', 'status', 'status_marketing',
            'hasil_scan', 'cutting_point', 'verifikasi_akhir'
        ])
        ->orderBy('id', 'DESC')
        ->get();

        $totalComplaint = $complaint->count();
        $totalOpen = $complaint->where('status', 'open')->count();
        $totalProses = $complaint->where('status', 'proses')->count();
        $totalSelesai = $complaint->whereIn('status', ['selesai', 'va'])->count();

        return view('keluhan.index', compact(
            'complaint',
            'totalComplaint',
            'totalOpen',
            'totalProses',
            'totalSelesai'
        ));
    }

    public function rverifikasi(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $currentTime = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $currentTime2 = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $query = Complaint::with(['results.defect', 'buyer:id,nama_buyer', 'departements', 'defect'])
            ->where('status', '=', 'va')
            ->whereBetween('tgl_keluhan', [
                $currentTime->format('Y-m-d'),
                $currentTime2->format('Y-m-d')
            ]);

        $complaint = $query->orderBy('id', 'DESC')->get();

        $totalData = $complaint->count();
        $totalSudahUpload = $complaint->filter(function($item) {
            return !empty($item->hasil_scan);
        })->count();
        $totalBelumUpload = $totalData - $totalSudahUpload;
        $totalCp = $complaint->sum('cutting_point');

        return view('keluhan.rekap_verifikasi', compact(
            'complaint',
            'currentTime',
            'currentTime2',
            'totalData',
            'totalSudahUpload',
            'totalBelumUpload',
            'totalCp'
        ));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekap(Request $request)
    {
        //  $complaint = Complaint::orderBy('id', 'DESC')->get();
        // $complaints = Result::first();
        // $complaints = Result::with('complaint')->first();
        // $result = Result::all();
        // $complaints = Complaint::with('results', 'buyer', 'departements', 'defect')->orderBy('id', 'DESC')->paginate(10);
        // $users = User::all();
        return view('keluhan.rekap.index', [
            // 'complaints' => $complaints
            // 'users' => $users
        ]);

    // return view('keluhan.rekap.index');
    }

    public function print($id)
    {
        // $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        $keluhan = Complaint::with('buyer')->findOrFail($id);
        $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();




        $pdf = PDF::loadview('keluhan.print', compact('icomplaint','keluhan'))
        ->setPaper('legal', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'chroot' => public_path(),
            'defaultFont' => 'sans-serif',
            'margin_top' => 0.1 * 72,    // 0 inch
            'margin_right' => 0.2 * 72,  // 0.2 inch
            'margin_bottom' => 0 * 72, // 0.5 inch
            'margin_left' => 0.2 * 72,   // 0.2 inch
        ]);

    $pdf->getDomPDF()->setHttpContext(
        stream_context_create([
            'ssl' => [
                'allow_self_signed' => TRUE,
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
            ]
        ])
    );

    set_time_limit(1200);

    return $pdf->stream();

    }

     public function pdf($id)
    {
        // $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        $keluhan = Complaint::with('buyer')->findOrFail($id);
        $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();

        $pdf = PDF::loadview('keluhan.print', compact('icomplaint','keluhan'))
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

     public function anyData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $currentTime = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $currentTime2 = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $query = Result::with(['departements', 'defect', 'complaint.buyer'])
            ->join('complaints', 'complaints.id', '=', 'result_complaints.complaints_id')
            ->join('buyers', 'buyers.id', '=', 'complaints.buyers_id')
            ->leftJoin('defects', 'defects.id', '=', 'result_complaints.defects_id')
            ->whereBetween('complaints.tgl_keluhan', [
                $currentTime->format('Y-m-d'),
                $currentTime2->format('Y-m-d')
            ])
            ->select(
                'result_complaints.*',
                'complaints.id as complaint_id',
                'complaints.nomer_keluhan',
                'complaints.tgl_keluhan',
                'complaints.nama_marketing',
                'complaints.no_wo',
                'complaints.no_sc',
                'complaints.nama_motif',
                'complaints.cw_qty',
                'complaints.masalah',
                'complaints.solusi',
                'complaints.is_verifikasi',
                'complaints.verifikasi_akhir',
                'complaints.status',
                'buyers.nama_buyer',
                'defects.nama as nama_defect'
            );

        if (!empty($status)) {
            $query->where('complaints.status', '=', $status);
        }

        $complaints = $query->orderBy('complaints.id', 'DESC')->get();

        $totalData = $complaints->count();
        $totalSelesai = $complaints->whereIn('status', ['selesai', 'closed'])->count();
        $totalProses = $complaints->whereIn('status', ['proses', 'va'])->count();
        $totalVerifikasi = $complaints->where('is_verifikasi', true)->count();

        return view('keluhan.rekap.index', compact(
            'complaints',
            'currentTime',
            'currentTime2',
            'status',
            'totalData',
            'totalSelesai',
            'totalProses',
            'totalVerifikasi'
        ));
    }

     public function dopen(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $currentTime = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $currentTime2 = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $query = Complaint::with('buyer:id,nama_buyer')
            ->whereBetween('tgl_keluhan', [
                $currentTime->format('Y-m-d'),
                $currentTime2->format('Y-m-d')
            ]);

        if (!empty($status)) {
            $query->where('status', '=', $status);
        } else {
            $query->whereIn('status', ['open', 'proses']);
        }

        $complaints = $query->orderBy('id', 'DESC')->get();

        $totalData = $complaints->count();
        $totalOpen = $complaints->where('status', 'open')->count();
        $totalProses = $complaints->where('status', 'proses')->count();
        $totalBuyer = $complaints->pluck('buyers_id')->filter()->unique()->count();

        return view('keluhan.rekap.rekap_open', compact(
            'complaints',
            'currentTime',
            'currentTime2',
            'status',
            'totalData',
            'totalOpen',
            'totalProses',
            'totalBuyer'
        ));
    }


    public function dverifikasi(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $currentTime = $startDate ? Carbon::parse($startDate) : Carbon::now()->startOfMonth();
        $currentTime2 = $endDate ? Carbon::parse($endDate) : Carbon::now()->endOfMonth();

        $query = Complaint::with([
            'buyer:id,nama_buyer',
        ])->whereBetween('tgl_keluhan', [
            $currentTime->format('Y-m-d'),
            $currentTime2->format('Y-m-d')
        ]);

        if (!empty($status)) {
            $query->where('status', '=', $status);
        }

        $complaints = $query->orderBy('id', 'DESC')->get();

        $totalData = $complaints->count();
        $totalUpload = $complaints->filter(function($item) {
            return !empty($item->upload_tindakan) || !empty($item->tindakan_verifikasi);
        })->count();
        $totalBelumUpload = $totalData - $totalUpload;
        $totalSelesai = $complaints->whereIn('status', ['selesai', 'va', 'closed'])->count();

        return view('keluhan.rekap.data_verifikasi', compact(
            'complaints',
            'currentTime',
            'currentTime2',
            'status',
            'totalData',
            'totalUpload',
            'totalBelumUpload',
            'totalSelesai'
        ));
    }

    public function cetak(Request $request)
    {

       $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

       $end_date = Carbon::parse($request->end_date)
                             ->toDateTimeString();

         $complaints = Complaint::with('results', 'buyer', 'departements', 'defect')->whereBetween('tgl_keluhan',[$start_date,$end_date])->orderBy('id', 'DESC')->paginate(30);

        $pdf = PDF::loadview('keluhan.rekap.cetak', compact('complaints'))
        ->setPaper('Legal', 'landscape');
         set_time_limit(1200);

        return $pdf->stream();

      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buyer = Buyer::all();
        $user = User::where('status', 1)->where('posisi', 'marketing')->orderBy('name')->get();
        $keluhan = Complaint::with('Buyer','Users')->get();


        return view('keluhan.create', [
            'keluhan' => $keluhan,
            'user' => $user,
            'buyer' => $buyer
        ]);
    }

    public function internal()
    {
        $buyer = Buyer::where('kategori_buyer', '=', 'internal')->get();
        // Hanya user yang berstatus aktif (status = 1) untuk Nama Yang Membuat / Pelapor
        $user = User::where('status', 1)->orderBy('name')->get();
        $keluhan = Complaint::with('Buyer','Users')->get();


        return view('keluhan.create_internal', [
            'keluhan' => $keluhan,
            'user' => $user,
            'buyer' => $buyer
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintRequest $request)
    {
        //untuk membuat penomeran urut otomatis
        //  $orderObj = Complaint::whereYear("created_at",Carbon::now()->year)->count();
        //  $nn = $orderObj + 1;

        $lastComplaint = Complaint::whereYear("created_at", Carbon::now()->year)->orderBy('no_urut', 'desc')->first();
        $no_urut = $lastComplaint ? $lastComplaint->no_urut + 1 : 1;


        //untuk mengambil huruf jenis
          if ($request->jenis == 'Dyeing') {
                $i_jenis = 'D';
            }
            elseif ($request->jenis == 'Printing') {
                $i_jenis ='P';
            }
            else {
                $i_jenis = 'W';
            }

        //penomeran no_keluhan
        //   $romawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        //     $cc = Complaint::whereYear("created_at",Carbon::now()->year)->count();
        //     $no = 0;
        //     if($cc) {
        //         $no_ak = sprintf("%02s", $cc+1). '/' . $i_jenis . '/' . $romawi[date('n')] .'/' . date('Y');
        //     }
        //     else {
        //         $no_ak = sprintf("%02s", $cc+1). '/' . $i_jenis . '/' . $romawi[date('n')] .'/' . date('Y');
        //     }

        // Penomeran no_keluhan dengan memperhitungkan no_urut baru
        $romawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $no_ak = sprintf("%02s", $no_urut) . '/' . $i_jenis . '/' . $romawi[date('n')] . '/' . date('Y');

        $complaint = new Complaint();
        $complaint->user_id = Auth::user()->id;
        $complaint->buyers_id = $request->buyers_id;
        $complaint->no_urut = $no_urut;
        $complaint->nomer_keluhan = $no_ak;
        $complaint->tgl_keluhan = $request->tgl_keluhan;
        $complaint->nama_marketing = $request->nama_marketing;
        $complaint->no_wo = $request->no_wo;
        $complaint->no_sc = $request->no_sc;
        $complaint->nama_motif = $request->nama_motif;
        $complaint->cw_qty = $request->cw_qty;
        $complaint->jenis = $request->jenis;
        $complaint->masalah = $request->masalah;
        $complaint->solusi = $request->solusi;
                        // $g_keluhan = $request->file('g_keluhan');
                        //     $ext = $g_keluhan->getClientOriginalExtension();
                        //     $newName = "kel"."-".rand(100000,1001238912).".".$ext;
                        //     $g_keluhan->move('image/keluhan',$newName);
                        //     $complaint->g_keluhan = $newName;
        // if($request->hasFile('g_keluhan')){
		// $filenameWithExt = $request->file('g_keluhan')->getClientOriginalName();
        // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // $extension = $request->file('g_keluhan')->getClientOriginalExtension();
        // $filenameSimpan = $filename.'_'.date('Ymd').'_'.time().'.'.$extension;
        // $path = $request->file('g_keluhan')->move('image/keluhan', $filenameSimpan);
	    // }else{
		// $filenameSimpan = '/image/keluhan/default.png';
	    // }
        $complaint->g_keluhan = 'default.png';
        $complaint->hasil_scan = null;
        $complaint->qty_complaint = $request->qty_complaint;
        $complaint->kategori_keluhan = 'eksternal';
        $complaint->save();



        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $request->id,'status'=>"done");
        $notification = array('nomer_keluhan' =>$no_ak, 'text' => $request->nama_marketing, 'text'=> $request->nama_motif, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAA88xwZGI:APA91bH4UDBrGGTEAKDCEr2BmbU9_m8zRVncKrGvPCt1qgvyVIDb7OYALvONKxSzG_XhyZmCX-cKWtGmmM249wSmLtG8Zpb_8y6iuYberPmwRePD8hK5UuIC8ew96wxqc9lF7XOjhJ5h",
            'Content-Type: application/json'
        );        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );



        $complaint->email = Auth::user()->email;

     $complaint->notify( new CreateComplaintNotification($complaint));

         Alert::info('Info', 'Data Tersimpan dan Masukkan Gambar Pendukung');
       return redirect('keluhan/show/' .  $complaint->id);
    //    return redirect()->route('keluhan.index');
    }

    public function store_internal(Request $request)
    {

        $validated = $request->validate([
            'buyers_id' => 'required',
             'tgl_keluhan' => 'required|date',
             'nama_marketing' => 'required',
             'no_wo' => 'required',
             'nama_motif' => 'required',
             'cw_qty' => 'required',
             'jenis' => 'required',
             'cw_qty' => 'required',
             'masalah' => 'required',
             'solusi' => 'required',
    ]);

        $lastComplaint = Complaint::whereYear("created_at", Carbon::now()->year)->orderBy('no_urut', 'desc')->first();
        $no_urut = $lastComplaint ? $lastComplaint->no_urut + 1 : 1;


        //untuk mengambil huruf jenis
          if ($request->jenis == 'Dyeing') {
                $i_jenis = 'D';
            }
            elseif ($request->jenis == 'Printing') {
                $i_jenis ='P';
            }
            else {
                $i_jenis = 'W';
            }


        $romawi = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $no_ak = sprintf("%02s", $no_urut) . '/' . $i_jenis . '/' . $romawi[date('n')] . '/' . date('Y');

        $complaint = new Complaint();
        $complaint->user_id = Auth::user()->id;
        $complaint->buyers_id = $request->buyers_id;
        $complaint->no_urut = $no_urut;
        $complaint->nomer_keluhan = $no_ak;
        $complaint->tgl_keluhan = $request->tgl_keluhan;
        $complaint->nama_marketing = $request->nama_marketing;
        $complaint->no_wo = $request->no_wo;
        $complaint->no_sc = '-';
        $complaint->nama_motif = $request->nama_motif;
        $complaint->cw_qty = $request->cw_qty;
        $complaint->jenis = $request->jenis;
        $complaint->masalah = $request->masalah;
        $complaint->solusi = $request->solusi;

        $complaint->g_keluhan = 'default.png';
        $complaint->hasil_scan = null;
        $complaint->qty_complaint = '-';
        $complaint->kategori_keluhan = 'internal';
        $complaint->save();



        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $request->id,'status'=>"done");
        $notification = array('nomer_keluhan' =>$no_ak, 'text' => $request->nama_marketing, 'text'=> $request->nama_motif, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => "/topics/all", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "AAAA88xwZGI:APA91bH4UDBrGGTEAKDCEr2BmbU9_m8zRVncKrGvPCt1qgvyVIDb7OYALvONKxSzG_XhyZmCX-cKWtGmmM249wSmLtG8Zpb_8y6iuYberPmwRePD8hK5UuIC8ew96wxqc9lF7XOjhJ5h",
            'Content-Type: application/json'
        );        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );



        $complaint->email = Auth::user()->email;

     $complaint->notify( new CreateComplaintNotification($complaint));

         Alert::info('Info', 'Data Tersimpan dan Masukkan Gambar Pendukung');
       return redirect('keluhan/show/' .  $complaint->id);
    //    return redirect()->route('keluhan.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $keluhan = Complaint::with('buyer')->findOrFail($id);

         $icomplaint = ImageComplaint::with('complaint')->where('complaints_id', '=', $id)->get();

        return view('keluhan.show', [
                'keluhan' => $keluhan,
                'icomplaint' => $icomplaint
        ]);
    }

    public function scan(Request $request)
    {
        $this->validate($request, [
             'hasil_scan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1500',
    ]);

        $scan = Complaint::findOrFail($request->complaints_id);

        // if (empty($request->file('hasil_scan'))){
        //         $scan->hasil_scan = $scan->hasil_scan;
        //     }
        //     else{
        //         unlink('image/scan/'.$scan->hasil_scan); //menghapus file lama
        //         $hasil_scan = $request->file('hasil_scan');
        //         $ext = $hasil_scan->getClientOriginalExtension();
        //         $newName = rand(100000,1001238912).".".$ext;
        //         $hasil_scan->move('image/scan',$newName);
        //         $scan->hasil_scan = $newName;
        //     }

		$hasil_scan = $request->file('hasil_scan');
            $ext = $hasil_scan->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $hasil_scan->move('image/scan',$newName);
            $scan->hasil_scan = $newName;
        $scan->save();

         Alert::success('Berhasil', 'Terimakasih Sudah Upload');
        return redirect()->back();
    }

    public function verifikasi(Request $request, Complaint $verifikasi)
    {
        $this->validate($request, [
        'cutting_point' => 'required|numeric',
        'verifikasi_akhir'   => 'required',
    ]);

        $verifikasi = Complaint::findOrFail($request->complaints_id);
		$verifikasi->cutting_point = $request->cutting_point;
        $verifikasi->verifikasi_akhir = $request->verifikasi_akhir;
        $verifikasi->is_verifikasi = '1';
        $verifikasi->save();

         Alert::success('Berhasil', 'Data Sudah Di Verifikasi');
        return redirect()->back();
    }


    public function uverifikasi(Request $request, Complaint $complaint)
    {
        $this->validate($request, [
             'tindakan_verifikasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1500',
    ]);

        $scan = Complaint::findOrFail($request->complaints_id);


        if ($request->is_uploadVa == true) {
            	$tindakan_verifikasi = $request->file('tindakan_verifikasi');
            $ext = $tindakan_verifikasi->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $tindakan_verifikasi->move('image/verifikasi',$newName);
            $scan->tindakan_verifikasi = $newName;
            $scan->status = 'closed';
        $scan->save();
        } elseif ($request->is_uploadVa == false) {
            $tindakan_verifikasi = false;
            $scan->status = 'closed';
        $scan->save();
        }



        $complaint->status = 'closed';
        $complaint->upload_tindakan = '1';
        $complaint->update();

        $complaint->email = Auth::user()->email;

        $complaint->notify(new UpdateProsesEmailComplaint($complaint));

         Alert::success('Berhasil', 'Terimakasih Sudah Upload Tindakan Verifikasi, Data Ini di Close');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer = Buyer::all();
        $keluhan = Complaint::with('buyer','users')->findOrFail($id);
        // Tampilkan user aktif atau pemilik keluhan yang sedang diedit
        $user = User::where('status', 1)
            ->orWhere('name', $keluhan->nama_marketing)
            ->orderBy('name')
            ->get();

        return view('keluhan.edit', [
                'keluhan' => $keluhan,
                'buyer' => $buyer,
                'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintRequest $request, Complaint $complaint)
    {
        {
        $complaint->buyers_id = $request->buyers_id;
        $complaint->tgl_keluhan = $request->tgl_keluhan;
        $complaint->nama_marketing = $request->nama_marketing;
        $complaint->no_wo = $request->no_wo;
        $complaint->no_sc = $request->no_sc;
        $complaint->nama_motif = $request->nama_motif;
        $complaint->cw_qty = $request->cw_qty;
        $complaint->jenis = $request->jenis;
        $complaint->masalah = $request->masalah;
        $complaint->solusi = $request->solusi;
        $complaint->g_keluhan = 'default.png';

        //CARA PERTAMA
        //         if ($g_keluhan = $request->file('g_keluhan')) {

        //     $destinationPath = 'image/keluhan/';

        //     $profileImage = date('YmdHis') . "." . $g_keluhan->getClientOriginalExtension();

        //     $g_keluhan->move($destinationPath, $profileImage);

        //     $complaint['g_keluhan'] = "$profileImage";

        // }else{

        //     unset($complaint['image']);

        // }

        //CARA UNTUK DEFAULTNYA ADA IMAGENYA LALU UPDATE TERGANTI
        // if (empty($request->file('g_keluhan'))){
        //         $complaint->g_keluhan = $complaint->g_keluhan;
        //     }
        // else{
        //         unlink('image/keluhan/'.$complaint->g_keluhan); //menghapus file lama
        //         $g_keluhan = $request->file('g_keluhan');
        //         $ext = $g_keluhan->getClientOriginalExtension();
        //         $newName = rand(100000,1001238912).".".$ext;
        //         $g_keluhan->move('image/keluhan',$newName);
        //         $complaint->g_keluhan = $newName;
        //     }
        $complaint->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('keluhan.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function egambar(Request $request, Complaint $complaint)
    {
        $request->validate([
        'g_keluhan' => 'required'
        ]);
        {
            if ($g_keluhan = $request->file('g_keluhan')) {

            $destinationPath = 'image/keluhan/';

            $profileImage = date('YmdHis') . "." . $g_keluhan->getClientOriginalExtension();

            $g_keluhan->move($destinationPath, $profileImage);

            $complaint['g_keluhan'] = "$profileImage";

        }else{

            unset($complaint['image']);

        }

        //CARA UNTUK DEFAULTNYA ADA IMAGENYA LALU UPDATE TERGANTI
        // if (empty($request->file('g_keluhan'))){
        //         $complaint->g_keluhan = $complaint->g_keluhan;
        //     }
        // else{
        //         unlink('image/keluhan/'.$complaint->g_keluhan); //menghapus file lama
        //         $g_keluhan = $request->file('g_keluhan');
        //         $ext = $g_keluhan->getClientOriginalExtension();
        //         $newName = rand(100000,1001238912).".".$ext;
        //         $g_keluhan->move('image/keluhan',$newName);
        //         $complaint->g_keluhan = $newName;
        //     }
        $complaint->update();

        Alert::success('Success', 'Gambar Berhasil Diubah');
        return redirect()->back();
        }
    }



    public function c_marketing(Request $request, Complaint $complaint)
    {
        $this->validate($request, [
        'solusi'   => 'required'
        ]);

    // if ( Auth::user()->id == $complaint->user_id ) {
    //    $complaint->status_marketing = '0';
    //    $complaint->solusi = $request->solusi;
    //     $complaint->update();
    //     Alert::success('Success', 'Complaint Telah Di Close dan Data Solusi Terisi');
    //     return redirect('keluhan');

    // }
    // else {
    //    Alert::warning('Info', 'Anda Bukan User Yang Membuat Data Complaint Ini');
    //     return redirect()->back();
    // }

    $complaint->status_marketing = '0';
       $complaint->solusi = $request->solusi;
        $complaint->update();
        Alert::success('Success', 'Complaint Telah Di Close dan Data Solusi Terisi');
        return redirect('keluhan');

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $keluhan=Complaint::find($id);
        $keluhan->delete();

        Alert::warning('Deleted', 'Data Complaint Berhasil di Hapus');

         return redirect()->route('keluhan.index');
    }
}
