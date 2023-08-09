<?php

namespace App\Http\Controllers;

use App\Models\Scommission;
use Illuminate\Http\Request;

class ScommissionController extends Controller
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
        if(!isPrivate() && !isAccountManager() && !isMerchant())
            abort(403);

        $scommissions = [];
        if(isPrivate() || isAccountManager()) {
            $scommissions = Scommission::orderBy('id', 'desc')->get();
        }
        else {
            if(getStandActive())
                $scommissions = Scommission::where('stand_id', getStandActive()->id)->orderBy('id', 'desc')->get();
        }

        $title = 'Liste des commissions';
        return view('pages/sCommissions/index', compact('title', 'scommissions'));
    }

    public function specific()
    {
        if(!isPrivate() && !isAccountManager() && !isMerchant())
            abort(403);

        $scommissions = [];
        if(getStandActive())
            $scommissions = Scommission::where('stand_id', getStandActive()->id)->orderBy('id', 'desc')->get();

        $title = 'Liste de vos commissions';
        return view('pages/sCommissions/index', compact('title', 'scommissions'));
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
     * @param  \App\Models\Scommission  $scommission
     * @return \Illuminate\Http\Response
     */
    public function show(Scommission $scommission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scommission  $scommission
     * @return \Illuminate\Http\Response
     */
    public function edit(Scommission $scommission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scommission  $scommission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scommission $scommission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scommission  $scommission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scommission $scommission)
    {
        //
    }
}
