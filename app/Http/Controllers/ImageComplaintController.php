<?php

namespace App\Http\Controllers;

use App\Models\ImageComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use File;
use Illuminate\Support\Facades\Storage;

class ImageComplaintController extends Controller
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
    public function store(Request $request)
    {
         $this->validate($request, [
             'complaints_id'   => 'required',
             'nama_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1500',
             'keterangan'   => 'required|max:200',
    ]);

        $icomplaint = new ImageComplaint();
        $icomplaint->complaints_id = $request->complaints_id;
        if($request->hasFile('nama_image')){
		$filenameWithExt = $request->file('nama_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('nama_image')->getClientOriginalExtension();
        $filenameSimpan = $filename.'_'.date('Ymd').'_'.time().'.'.$extension;
        $path = $request->file('nama_image')->move('image/keluhan', $filenameSimpan);
	    }else{
		$filenameSimpan = '/image/keluhan/default.png';
	    }
        $icomplaint->nama_image = $filenameSimpan;
        $icomplaint->keterangan = $request->keterangan;
        $icomplaint->save();

         Alert::success('Berhasil', 'Silahkan Tambah Gambar Pendukung');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageComplaint  $imageComplaint
     * @return \Illuminate\Http\Response
     */
    public function show(ImageComplaint $imageComplaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageComplaint  $imageComplaint
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageComplaint $imageComplaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageComplaint  $imageComplaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageComplaint $imageComplaint)
    {
        //
    }


    public function hapusGambar(ImageComplaint $imageComplaint)
    {
        $exist = Storage::disk('image/keluhan')->exists($imageComplaint->nama_image);

        if(isset($imageComplaint->nama_image) && $exist){
            $delete = Storage::disk('image/keluhan')->delete($imageComplaint->g_clie);
                if ($delete){
                    return true;
                }
                return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageComplaint  $imageComplaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $imageComplaint = ImageComplaint::find($request->id);

        unlink("image/keluhan/".$imageComplaint->nama_image);

        ImageComplaint::where("id", $imageComplaint->id)->delete();


        Alert::warning('Deleted', 'Gambar Pendukung Berhasil di Hapus');
        return back();
    }
}