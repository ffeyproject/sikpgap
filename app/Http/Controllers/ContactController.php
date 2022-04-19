<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)
    {
        $contact = Contact::orderBy("id", "desc")->get();
         return view('master.contact.index', compact('contact'));
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
        'message'   => 'required|max:100'
    ]);

            $cc = Contact::whereYear("created_at",Carbon::now()->year)->count();
            $no = 0;
            if($cc) {
                $no_ak = sprintf("%02s", $cc+1). '/' . date('Y');
            }
            else {
                $no_ak = sprintf("%02s", $cc+1). '/' . date('Y');
            }

     $contact = new Contact();
        $contact->user_id = Auth::user()->id;
        $contact->kode_contact = $no_ak;
        $contact->message = $request->message;
        $contact->status = 'Terkirim';
        $contact->save();

        Alert::success('Congrats', 'Pesan Telah Terkirim');

     return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $pesan)
    {
         $pesan->delete();
        return redirect()->route('pesan.index')->with('delete', 'Data Pesan Berhasil Di Hapus');
    }
}
