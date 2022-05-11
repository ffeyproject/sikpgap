<?php

namespace App\Http\Controllers;

use App\Models\ImageClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ImageClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = ImageClient::all();
         return view('image.client.index', compact('image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('image.client.create');
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
        'nama_client'   => 'required|max:100',
        'g_client' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1500',
        'status' => 'required',
    ]);

         $image = new ImageClient();
        $image->user_id = Auth::user()->id;
        $image->nama_client = $request->nama_client;
        $g_client = $request->file('g_client');
            $ext = $g_client->getClientOriginalExtension();
            $newName = rand(100000,1001238912).".".$ext;
            $g_client->move('image/client',$newName);
            $image->g_client = $newName;
        $image->status = $request->status;
        $image->save();

        Alert::success('Congrats', 'Client created successfully.');

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageClient  $imageClient
     * @return \Illuminate\Http\Response
     */
    public function show(ImageClient $imageClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageClient  $imageClient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $image = ImageClient::findOrFail($id);

        return view('image.client.edit', [
                'image' => $image
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ImageClient  $imageClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageClient $image)
    {
        $request->validate([
            'g_client' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1500',
            'nama_client' => 'required',
            'status' => 'required'
           ]);

        $image->user_id = Auth::user()->id;
        $image->nama_client = $request->nama_client;
        if (empty($request->file('g_client'))){
                $image->g_client = $image->g_client;
            }
            else{
                unlink('image/client/'.$image->g_client); //menghapus file lama
                $g_client = $request->file('g_client');
                $ext = $g_client->getClientOriginalExtension();
                $newName = rand(100000,1001238912).".".$ext;
                $g_client->move('image/client',$newName);
                $image->g_client = $newName;
            }
        $image->status = $request->status;
        $image->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('client.index');
    }

    public function hapusGambar(ImageClient $image)
    {
        $exist = Storage::disk('image/client')->exists($image->g_client);

        if(isset($image->g_clients) && $exist){
            $delete = Storage::disk('g_client')->delete($image->g_client);
                if ($delete){
                    return true;
                }
                return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageClient  $imageClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageClient $image)
    {
        $this->hapusGambar($image);
        $image->delete();

         Alert::warning('Deleted', 'Data Client Berhasil di Hapus');
        return redirect()->route('client.index');
    }
}