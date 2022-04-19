<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuyerRequest;
use App\Models\buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BuyerController extends Controller
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
    public function index(Buyer $buyer, Request $request)
    {
        $buyer = Buyer::all();

        return view('master.buyer.index', [
            'buyer' => $buyer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.buyer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuyerRequest $request)
    {
        $orderObj = DB::table('buyers')->select('kode_buyer')->latest('kode_buyer')->first();
        if ($orderObj) {
            $orderNr = $orderObj->kode_buyer;
            $removed1char = substr($orderNr, 4);
            $kbuyer = 'B-' . str_pad($removed1char + 1, 5, "0", STR_PAD_LEFT);
        } else {
            $kbuyer = "B-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }

        $buyer = new Buyer();
        $buyer->user_id = Auth::user()->id;
        $buyer->kode_buyer = $kbuyer;
        $buyer->nama_buyer = $request->nama_buyer;
        $buyer->alamat_buyer = $request->alamat_buyer;
        $buyer->cp_buyer = $request->cp_buyer;
        $buyer->telp_buyer = $request->telp_buyer;
        $buyer->email_buyer = $request->email_buyer;
        $buyer->save();

        Alert::success('Congrats', 'Data Berhasil Ditambahkan');

        return redirect()->route('buyer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer = buyer::findOrFail($id);

        return view('master.buyer.show', [
                'buyer' => $buyer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(BuyerRequest $request, buyer $buyer)
    {
        $buyer->nama_buyer = $request->nama_buyer;
        $buyer->alamat_buyer = $request->alamat_buyer;
        $buyer->cp_buyer = $request->cp_buyer;
        $buyer->telp_buyer = $request->telp_buyer;
        $buyer->email_buyer = $request->email_buyer;
        $buyer->update();

        Alert::success('Success', 'Data Berhasil Diupdate');

        return redirect()->route('buyer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(buyer $buyer)
    {
        $buyer->delete();

        Alert::warning('Deleted', 'Data Buyer Berhasil di Hapus');

        return redirect()->route('buyer.index');
    }
}
