<?php

namespace App\Http\Controllers;

use App\Models\MenuDashboard;
use Illuminate\Http\Request;

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
        //
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
    public function edit(MenuDashboard $menuDashboard)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MenuDashboard  $menuDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuDashboard $menuDashboard)
    {
        //
    }
}