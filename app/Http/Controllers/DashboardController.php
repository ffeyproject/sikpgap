<?php

namespace App\Http\Controllers;

use App\Http\Requests\KepuasanRequest;
use App\Http\Requests\ResulSatisfactionRequest;
use App\Models\buyer;
use App\Models\Contact;
use App\Models\ImageClient;
use App\Models\ItemEvalution;
use App\Models\ResultSatis;
use App\Models\Satisfaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

//     public function __construct()
// {

//     $this->middleware("customer");

// }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.login.index');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $image = ImageClient::where('status', 'LIKE', 'Ya')->get();

        return view('customer.home', compact('image'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function penilaian()
    {
        $image = ImageClient::where('status', 'LIKE', 'Ya')->get();
        $kepuasan = Satisfaction::where('user_id', Auth::id())->orderBy('id','desc')->paginate(8);

        return view('customer.penilaian.penilaian', compact('kepuasan', 'image'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $contact = Contact::where('user_id', Auth::id())->orderBy('id','desc')->paginate(5);

        $image = ImageClient::all();

        return view('customer.contact', compact('contact', 'image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $image = ImageClient::all();
         $kepuasan = Satisfaction::all();
        // $buyer = DB::table("buyers")->select("id","nama_buyer","alamat_buyer","cp_buyer")->get();
        $buyer = buyer::pluck('nama_buyer', 'id');
        return view('customer.penilaian.create', compact('image', 'kepuasan', 'buyer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KepuasanRequest $request)
    {
        //untuk membuat penomeran urut otomatis
         $orderObj = Satisfaction::whereYear("created_at",Carbon::now()->year)->count();
         $nn = $orderObj + 1;


        //penomeran no_keluhan
            $cc = Satisfaction::whereYear("created_at",Carbon::now()->year)->count();
            $no = 0;
            if($cc) {
                $no_ak = "B" .'-'. sprintf("%02s", $cc+1). '-' . date('Y');
            }
            else {
                $no_ak = "B" .'-'. sprintf("%02s", $cc+1). '-' . date('Y');
            }

        $kepuasan = new Satisfaction();
        $kepuasan->user_id = Auth::user()->id;
        $kepuasan->buyers_id = $request->buyers_id;
        $kepuasan->no_urut = $nn;
        $kepuasan->kode_penilaian = $no_ak;
        $kepuasan->nama_kontak = $request->nama_kontak;
        $kepuasan->alamat = $request->alamat;
        $kepuasan->tgl_penilaian = $request->tgl_penilaian;
        $kepuasan->desc_kesesuaian = '-';
        $kepuasan->kritik_saran = '-';
        $kepuasan->status = "open";
        $kepuasan->save();

        return redirect('customer-penilaian/index/' .  $kepuasan->id)->with('info', 'Silahkan Isi Penilaian.');
    }

    public function cvpenilaian($id)
    {

        $image = ImageClient::all();
        $item = ItemEvalution::all();
        $aq = Satisfaction::all();
        $buyer = buyer::all();
        $kepuasan = Satisfaction::with('buyer', 'itemevaluation')->where('user_id', Auth::id())->findOrFail($id);
        $detail = ResultSatis::with('satisfaction','itemevaluation')->where('satisfactions_id', '=', $id)->where('user_id', Auth::id())->get();

        return view('customer.penilaian.index', compact('image','kepuasan', 'detail', 'item', 'aq', 'buyer'));
    }


    public function spenilaian(ResulSatisfactionRequest $request)
    {
        $data = $request->except('_token');

		$subject_count = count($data['item_evaluations_id']);
		for($i=0; $i < $subject_count; $i++){

			$abc = new ResultSatis();
			$abc->item_evaluations_id = $data['item_evaluations_id'][$i];
			$abc->satisfactions_id = $data['satisfactions_id'];
			$abc->score = $data['score'][$i];
			$abc->user_id = Auth::user()->id;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}