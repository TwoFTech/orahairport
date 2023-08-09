<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\SettingsUpdateRequest;

class SettingController extends Controller
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
        if(!isPrivate())
            abort(403);

        $title = 'Paramètres';
        $settings = Setting::first();
        $countriesAccepted = Country::whereStatus(true)->orderBy('name')->get();
        return view('pages/settings/index', compact('title', 'settings', 'countriesAccepted'));
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($field)
    {
        if(!isPrivate())
            abort(403);

        $title = 'Modifier des paramètres';
        $settings = Setting::first();
        return view('pages/settings/edit', compact('title', 'settings', 'field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsUpdateRequest $request)
    {
        if(!isPrivate())
            abort(403);
        
        $settings = Setting::first();
        $settings->update([
            'stand_amount' => $request['stand_amount'],
            'currency' => $request['currency'],
            'tva_tax' => $request['tva_tax'],
            'dev_commission_on_point' => $request['dev_commission_on_point'],
            'dev_commission_on_reservation' => $request['dev_commission_on_reservation']
        ]);
        return redirect()->route('settings.index')->with('success', 'Modifications effecuées avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
