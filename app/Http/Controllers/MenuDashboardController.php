<?php

namespace App\Http\Controllers;

use App\Models\MenuDashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MenuDashboardController extends Controller
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
       $menuDashboard = MenuDashboard::all();

        return view('master.menu.index', [
            'menuDashboard' => $menuDashboard
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.menu.create');
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
        'categori_menu'   => 'required',
        'item_menu'   => 'required',
        'ket_menu'   => 'required'
        ]);

         $menuDashboard = new MenuDashboard();
        $menuDashboard->user_id = Auth::user()->id;
        $menuDashboard->categori_menu = $request->categori_menu;
        $menuDashboard->item_menu = $request->item_menu;
        $menuDashboard->ket_menu = $request->ket_menu;
        $menuDashboard->status = 'Aktif';
        $menuDashboard->save();

        Alert::success('Congrats', 'Data Berhasil Ditambahkan');

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MenuDashboard  $menuDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(MenuDashboard $menuDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MenuDashboard  $menuDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuDashboard = MenuDashboard::findOrFail($id);

        return view('master.menu.edit', [
                'menuDashboard' => $menuDashboard
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuDashboard  $menuDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuDashboard $menuDashboard)
    {
         $this->validate($request, [
        'categori_menu'   => 'required',
        'item_menu'   => 'required',
        'ket_menu'   => 'required',
        'status'   => 'required'
        ]);

        $menuDashboard->categori_menu = $request->categori_menu;
        $menuDashboard->item_menu = $request->item_menu;
        $menuDashboard->ket_menu = $request->ket_menu;
        $menuDashboard->status = $request->status;
        $menuDashboard->update();

        Alert::success('Success', 'Data Berhasil Diupdate');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuDashboard  $menuDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuDashboard $menuDashboard)
    {
        $menuDashboard->delete();

        Alert::warning('Deleted', 'Data Berhasil di Hapus');

        return redirect()->route('menu.index');
    }
}